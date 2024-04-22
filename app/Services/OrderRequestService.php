<?php

namespace App\Services;

use App\Models\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderRequestMessage;
use App\Models\Tutor;
use App\Models\User;
use App\Models\OrderAssign;
use App\Models\QcAssign;
use App\Models\TeacherOrderMessage;
use App\Models\QcOrderMessage;

/**
 * Class OrderService.
 */
class OrderRequestService
{
    public function pending($type = 'TUTOR')
    {
        $userId = Auth::user()->id;
        $orderRequests = OrderRequest::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
            ->where('tutor_id', $userId)
            ->whereNot('status', 'REJECTED')
            ->where('type', $type)
            ->get();
        return ['orderRequests' => $orderRequests];
    }

    public function details($id)
    {
        $userId = Auth::user()->id;
        $orderRequest = OrderRequest::with([
            'teacher',
            'order',
            'order.lavelStudy',
            'order.referencingStyle',
            'order.grade',
            'order.website',
            'order.subject',
            'order.student'
        ])->where('id', $id)->where('tutor_id', $userId)->first();

        $teacherOrderMessage = [];
        $orderAssign = [];
        $qcAssign = [];
        $orderMessage = [];
        $teacherOrderMessage = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $id)->get();


        if ($orderRequest->type == 'TUTOR') {
            $orderAssign = OrderAssign::where('order_id', $orderRequest->order_id)->first();
            $orderMessage = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderRequest->order_id)->get();
        } else if ($orderRequest->type == 'QC') {
            $qcAssign = QcAssign::where('order_id', $orderRequest->order_id)->first();
            $orderMessage = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderRequest->order_id)->get();
        }

        return [
            'orderRequest' => $orderRequest,
            'teacherOrderMessage' => $teacherOrderMessage,
            'orderAssign' => $orderAssign,
            'qcAssign' => $qcAssign,
            'orderMessage' => $orderMessage,
        ];
    }

    public function actionOnRequest($request)
    {
        if ($request->exists('ACCEPT')) {
            return $this->acceptOrderRequest($request->id);
        } else {
            return $this->rejectOrderRequest($request->id);
        }
    }

    public function acceptOrderRequest($id)
    {
        try {
            $orderRequest = OrderRequest::find($id);
            $orderRequest->status = 'ACCEPTED';
            $orderRequest->save();
            return ['message' => 'You have successfully accepted', 'status' => 'success', 'data' => $orderRequest];
        } catch (\Exception $e) {
            return ['message' => 'Something went wrong', 'status' => 'error', 'data' => $orderRequest];
        }
    }

    public function rejectOrderRequest($id)
    {
        try {
            $orderRequest = OrderRequest::find($id);
            $orderRequest->status = 'REJECTED';
            $orderRequest->save();
            return ['message' => 'You have successfully rejected', 'status' => 'success', 'data' => $orderRequest];
        } catch (\Exception $e) {
            return ['message' => 'Something went wrong', 'status' => 'error', 'data' => $orderRequest];
        }
    }

    public function saveRequestMessage($request)
    {
        try {
            $attachment = '';
            if ($request->has("attachment")) {

                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = env('APP_URL') . '/images/uploads/attachment/' . $attachmentName;
            }
            OrderRequestMessage::create([
                'sendertable_id' => Auth::user()->id,
                'sendertable_type' => Tutor::class,
                'receivertable_id' => 1,
                'receivertable_type' => User::class,
                'request_id' => $request->id,
                'message' => $request->message,
                'attachment' => $attachment
            ]);
            return ['message' => 'Message sent', 'status' => 'success'];
        } catch (\Exception $e) {
            echo $e;
            die;
            return ['message' => 'Something went wrong', 'status' => 'error'];
        }
    }



    public function submitFinalBudget($request)
    {

        $orderRequest = OrderRequest::find($request->id);
        $budget = $request->final_budget_amount;
        if ($orderRequest->type == 'TUTOR') {
            OrderAssign::Create([
                'order_id' => $orderRequest->order_id,
                'student_id' => $orderRequest->student_id,
                'tutor_id' => $orderRequest->tutor_id,
                'tutor_price' => $budget,
                'message' => ''
            ]);
        } else if ($orderRequest->type == 'QC') {
            QcAssign::Create([
                'order_id' => $orderRequest->order_id,
                'student_id' => $orderRequest->student_id,
                'qc_id' => $orderRequest->tutor_id,
                'qc_price' => $budget,
            ]);
        }
        return ['message' => 'Order assigned', 'status' => 'success'];
    }

    public function submitFinalDocument($request, $orderId)
    {
        try {
            $attachment = '';
            if ($request->has("attachment")) {
                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = env('APP_URL') . '/images/uploads/attachment/' . $attachmentName;
            }


            $orderRequest = OrderRequest::where('order_id', $orderId)->where('type', $request->type)->first();



            if ($request->type == 'TUTOR') {
                $orderAssign = OrderAssign::where('order_id', $orderId)
                    ->where('tutor_id', $orderRequest->tutor_id)->first();
            } else {
                $orderAssign = QcAssign::where('order_id', $orderId)
                    ->where('qc_id', $orderRequest->tutor_id)->first();
            }



            $orderAssign->status = 'COMPLETED';
            $orderAssign->attachment = $attachment;
            $orderAssign->save();
            return ['message' => 'Order assigned', 'status' => 'success'];
        } catch (\Exception $e) {
            echo $e;
            die;
            return ['message' => 'Error', 'status' => 'error'];
        }
    }
}

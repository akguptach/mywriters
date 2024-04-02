<?php

namespace App\Services;

use App\Models\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderRequestMessage;
use App\Models\Tutor;
use App\Models\User;

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
            //->where('status', 'PENDING')
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
            'order.subject'
        ])
            ->where('id', $id)
            ->where('tutor_id', $userId)
            ->first();

        $teacherOrderMessage = [];
        $teacherOrderMessage = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $id)->get();
        /*echo "<pre>";
        print_r($teacherOrderMessage[0]->sendertable->tutor_first_name);
        die;*/
        return ['orderRequest' => $orderRequest, 'teacherOrderMessage' => $teacherOrderMessage];
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
            return ['message' => 'You have successfully accepted', 'status' => 'success'];
        } catch (\Exception $e) {
            return ['message' => 'Something went wrong', 'status' => 'error', 'id' => $id];
        }
    }

    public function rejectOrderRequest($id)
    {
        try {
            $orderRequest = OrderRequest::find($id);
            $orderRequest->status = 'REJECTED';
            $orderRequest->save();
            return ['message' => 'You have successfully rejected', 'status' => 'success', 'id' => $id];
        } catch (\Exception $e) {
            return ['message' => 'Something went wrong', 'status' => 'error', 'id' => $id];
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
                $attachment = 'images/uploads/attachment/' . $attachmentName;
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
}

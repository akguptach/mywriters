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
class OrderService
{
    public function openOrders($type = 'tutor')
    {
        $type = strtoupper($type);
        $userId = Auth::user()->id;
        if ($type == 'TUTOR') {
            $openOrders = OrderAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
                ->where('tutor_id', $userId)
                ->get();
        } else {
            $openOrders = QcAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
                ->where('qc_id', $userId)
                ->get();
        }
        return ['openOrders' => $openOrders];
    }

    public function openOrderDetails($id)
    {
        $type = 'TUTOR';
        $userId = Auth::user()->id;
        $orderAssign = OrderAssign::with([
            'teacher',
            'order',
            'order.lavelStudy',
            'order.referencingStyle',
            'order.grade',
            'order.website',
            'order.subject',
            'order.student'
        ])->where('id', $id)->where('tutor_id', $userId)->first();


        //  $orderAssign = OrderAssign::where('order_id', $orderAssign->order_id)->first();
        $orderMessage = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderAssign->order_id)->get();
        return ['orderAssign' => $orderAssign, 'orderMessage' => $orderMessage, 'type' => $type];
    }

    public function qcOpenOrderDetails($id)
    {

        $type = 'QC';
        $userId = Auth::user()->id;
        $orderAssign = QcAssign::with([
            'qc',
            'order',
            'order.lavelStudy',
            'order.referencingStyle',
            'order.grade',
            'order.website',
            'order.subject',
            'order.student'
        ])->where('id', $id)->where('qc_id', $userId)->first();


        //  $orderAssign = OrderAssign::where('order_id', $orderAssign->order_id)->first();
        $orderMessage = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderAssign->order_id)->get();
        return ['orderAssign' => $orderAssign, 'orderMessage' => $orderMessage, 'type' => $type];
    }

    public function saveOrderMessage($request)
    {

        try {
            $attachment = '';
            if ($request->has("attachment")) {

                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = 'images/uploads/attachment/' . $attachmentName;
            }

            if ($request->type == 'TUTOR') {
                TeacherOrderMessage::Create([
                    'order_id' => $request->order_id,
                    'sendertable_id' => Auth::user()->id,
                    'sendertable_type' => Tutor::class,
                    'receivertable_id' => 1,
                    'receivertable_type' => User::class,
                    'message' => $request->message,
                    'attachment' => $attachment
                ]);
            } else {

                QcOrderMessage::Create([
                    'order_id' => $request->order_id,
                    'sendertable_id' => Auth::user()->id,
                    'sendertable_type' => Tutor::class,
                    'receivertable_id' => 1,
                    'receivertable_type' => User::class,
                    'message' => $request->message,
                    'attachment' => $attachment
                ]);
            }
            return ['message' => 'Message sent', 'status' => 'success'];
        } catch (\Exception $e) {
            echo $e;
            die;
            return ['message' => 'Something went wrong', 'status' => 'error'];
        }
    }
}

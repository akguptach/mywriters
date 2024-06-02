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
use Illuminate\Support\Facades\Mail;

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
                ->where('status', 'PENDING')
                ->get();
        } else {
            $openOrders = QcAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
                ->where('qc_id', $userId)
                ->where('status', 'PENDING')
                ->get();
        }
        return ['openOrders' => $openOrders];
    }

    public function completedOrders($type = 'tutor')
    {
        $type = strtoupper($type);
        $userId = Auth::user()->id;
        if ($type == 'TUTOR') {
            $openOrders = OrderAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
                ->where('tutor_id', $userId)
                ->where('status', 'COMPLETED')
                ->get();
        } else {
            $openOrders = QcAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
                ->where('qc_id', $userId)
                ->where('status', 'COMPLETED')
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
        $qcAssign = QcAssign::with([
            'qc',
            'order',
            'order.lavelStudy',
            'order.referencingStyle',
            'order.grade',
            'order.website',
            'order.subject',
            'order.student'
        ])->where('id', $id)->where('qc_id', $userId)->first();


        $orderAssign = OrderAssign::where('order_id', $qcAssign->order_id)->first();
        $orderMessage = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderAssign->order_id)->get();
        return ['qcAssign' => $qcAssign, 'orderAssign' => $orderAssign, 'orderMessage' => $orderMessage, 'type' => $type];
    }

    public function saveOrderMessage($request)
    {

        try {
            $attachment = '';
            if ($request->has("attachment")) {

                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = env('APP_URL', '/') . '/images/uploads/attachment/' . $attachmentName;
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
                $orderAssign = OrderAssign::where('order_id', $request->order_id)->first();
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
                $orderAssign = QcAssign::where('order_id', $request->order_id)->first();

            }
            //////
            $admin = User::find(1);
            $url = env('ADMIN_URL','https://500m.in').'/orders/'.$request->order_id.'/view';
            $data = ['url'=>$url,'messageContent'=>$request->message];
            try {
                Mail::send('emails.500.message', $data, function ($message) use ($data, $admin) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->subject("Message received");
                    $message->to(env('APP_TEST_EMAIL', $admin->email));
                });
    
            } catch (\Exception $e) {
                echo $e; die;
            }
            /////
            return ['message' => 'Message sent', 'status' => 'success'];
        } catch (\Exception $e) {
            echo $e;
            die;
            return ['message' => 'Something went wrong', 'status' => 'error'];
        }
    }
}
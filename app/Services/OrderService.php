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
use Illuminate\Support\Facades\DB;
use DataTables;

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
            $openOrders = OrderAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade','order.taskType','order.website'])
                ->where('tutor_id', $userId)
                ->where('status', 'PENDING');


                
        } else {
            $openOrders = QcAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade','order.taskType','order.website'])
                ->where('qc_id', $userId)
                ->where('status', 'PENDING');
        }
        $openOrders->orderBy('order_id', 'DESC');

        return DataTables::eloquent($openOrders)


                ->filterColumn('level_name', function($query, $keyword) {
                    $query->whereHas('order.lavelStudy', fn($q) => $q->where('level_name', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('type_name', function($query, $keyword) {
                    $query->whereHas('order.taskType', fn($q) => $q->where('type_name', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('style', function($query, $keyword) {
                    $query->whereHas('order.referencingStyle', fn($q) => $q->where('style', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('no_of_words', function($query, $keyword) {
                    $query->whereHas('order', fn($q) => $q->where('no_of_words', 'LIKE', '%' . $keyword . '%'));
                })
                ->toJson();

        
    }

    public function completedOrders($type = 'tutor')
    {
        $type = strtoupper($type);
        $userId = Auth::user()->id;
        if ($type == 'TUTOR') {
            $openOrders = OrderAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade','order.taskType','order.website'])
                ->where('tutor_id', $userId)
                ->where('status', 'COMPLETED');
        } else {
            $openOrders = QcAssign::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade','order.taskType','order.website'])
                ->where('qc_id', $userId)
                ->where('status', 'COMPLETED');
        } 
        $openOrders->orderBy('order_id', 'DESC');
        return DataTables::eloquent($openOrders)
                ->filterColumn('level_name', function($query, $keyword) {
                    $query->whereHas('order.lavelStudy', fn($q) => $q->where('level_name', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('type_name', function($query, $keyword) {
                    $query->whereHas('order.taskType', fn($q) => $q->where('type_name', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('style', function($query, $keyword) {
                    $query->whereHas('order.referencingStyle', fn($q) => $q->where('style', 'LIKE', '%' . $keyword . '%'));
                })
                ->filterColumn('no_of_words', function($query, $keyword) {
                    $query->whereHas('order', fn($q) => $q->where('no_of_words', 'LIKE', '%' . $keyword . '%'));
                })
                ->toJson();
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


        DB::table('teacher_order_messages')
            ->where('order_id', $orderAssign?->order_id)
            ->where('receivertable_type', Tutor::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

        //  $orderAssign = OrderAssign::where('order_id', $orderAssign->order_id)->first();
        $orderMessage = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $orderAssign?->order_id)->get();
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


        DB::table('qc_order_messages')
            ->where('order_id', $qcAssign->order_id)
            ->where('receivertable_type', Tutor::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

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
                $orderMessage = TeacherOrderMessage::Create([
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

                $orderMessage = QcOrderMessage::Create([
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
            $orderMessage->url = $url;
            $orderMessage->save();
            try {
                Mail::send('emails.500.message', $data, function ($message) use ($data, $admin) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->subject("Message received");
                    $message->to(env('ADMIN_EMAIL', $admin->email));
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


    public function orderEarning()
    {
        
        $userId = Auth::user()->id;
        //$tutorOrders = OrderAssign::where('tutor_id', $userId)->where('status', 'COMPLETED');
       // $qcOrders = QcAssign::addSelect(['id'])->with(['order'])->where('qc_id', $userId)->where('status', 'COMPLETED');
       // $orders = $tutorOrders->union($qcOrders);
       $tutorOrders = DB::table('order_assign')
       ->select(['orders.order_number','order_assign.id', 'order_assign.tutor_price as earn','order_assign.order_id','orders.created_at'])
    ->addSelect(\DB::raw('"TUTOR" as type'))
       ->join('orders', 'orders.id', '=', 'order_assign.order_id')
       ->where('order_assign.tutor_id', $userId)->where('order_assign.status', 'COMPLETED');

       $qcOrders = DB::table('qc_assign')
       ->select(['orders.order_number','qc_assign.id', 'qc_assign.qc_price as earn','qc_assign.order_id','orders.created_at'])
       ->addSelect(\DB::raw('"QC" as type'))
       ->join('orders', 'orders.id', '=', 'qc_assign.order_id')
       ->where('qc_assign.qc_id', $userId)->where('qc_assign.status', 'COMPLETED');
        $order = $tutorOrders->union($qcOrders);

        return DataTables::query($order)
        ->addColumn('earn', function($row) {
            return '£'.$row->earn;
        })

        ->addColumn('order_id', function($row) {
            if($row->type=='TUTOR')
                return '<a style="color:blue;" href="'.route('open.order.details',$row->id).'">'.$row->order_number.'</a>';
            else 
                return '<a style="color:blue;" href="'.route('qc.open.order.details',$row->id).'">'.$row->order_number.'</a>';
        })

        ->addColumn('created_at', function($row) {
            return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y');
        })
        ->rawColumns(['order_id'])->toJson();
    }

}
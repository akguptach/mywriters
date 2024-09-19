<?php

namespace App\Services;
use App\Models\Notification;
use DataTables;
use Illuminate\Support\Facades\Auth;

class NotificationService
{

    public function getNotifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')
        ->where('receivertable_type','App\Models\Tutor')
        ->where('receivertable_id',AUTH::user()->id);
        return DataTables::eloquent($notifications)
        ->addColumn('order_id', function($row) {
            if($row->order_id)
                return '<a style="color:blue;" href="'.$row->url.'">'.$row->order->order_number.'</a>';
            else
                return '<a style="color:blue;" href="'.$row->url.'">'.$row->order_request->order->order_number.'</a>';
        })
        ->addColumn('sender', function($row) {
            return $row->sendertable->name;
        })

        ->addColumn('receiver', function($row) {
            return $row->receivertable->tutor_first_name;
        })
        
        ->rawColumns(['order_id'])->toJson();
        ;
    }


    
}
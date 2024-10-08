<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\OrderRequestMessageRequest;
use App\Models\OrderAssign;
use App\Models\QcAssign;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct(protected OrderService $orderService)
    {
    }

    

    public function account()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return $this->orderService->orderEarning();
            
        }else{
            $userId = Auth::user()->id;
            $tutorOrders = OrderAssign::where('tutor_id', $userId)->where('status', 'COMPLETED')->sum('tutor_price');
            $qcOrders = QcAssign::addSelect(['id'])->with(['order'])->where('qc_id', $userId)->where('status', 'COMPLETED')->sum('qc_price');
            $total = $tutorOrders+$qcOrders;
            return view('orders/account',compact('total'));
        }

        
    }


    public function completed($type = 'tutor')
    {
        $type = strtoupper($type);
        if (isset($_GET) && !empty($_GET['columns'])) {
            return $this->orderService->completedOrders($type);
        }else{
            $data['type'] = $type;
            return view('orders/completed', $data);
        }
    }



    public function open($type = 'tutor')
    {
        $type = strtoupper($type);
        if (isset($_GET) && !empty($_GET['columns'])) {
            return $this->orderService->openOrders($type);
        }
        else{
            $data['type'] = $type;
            return view('orders/open', $data);
        }
    }

    public function openOrderDetails(OrderRequestMessageRequest $request, $id)
    {
        if ($request->isMethod('post')) {
            $result = $this->orderService->saveOrderMessage($request);
            return redirect()->back()->with($result['status'], $result['message']);
        }
        return view('orders/open_order_details', $this->orderService->openOrderDetails($id));
    }

    public function qcOpenOrderDetails(OrderRequestMessageRequest $request, $id)
    {
        if ($request->isMethod('post')) {
            $result = $this->orderService->saveOrderMessage($request);
            return redirect()->back()->with($result['status'], $result['message']);
        }
        return view('orders/qc_open_order_details', $this->orderService->qcOpenOrderDetails($id));
    }
}
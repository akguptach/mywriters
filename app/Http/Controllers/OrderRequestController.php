<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderRequestService;
use App\Http\Requests\OrderRequestAcceptRequest;
use App\Http\Requests\OrderRequestMessageRequest;

class OrderRequestController extends Controller
{


    public function __construct(protected OrderRequestService $orderRequestService)
    {
    }

    public function pending($type)
    {
        return view('requests.pending', $this->orderRequestService->pending($type));
    }

    public function details(OrderRequestMessageRequest $request, $id)
    {
        if ($request->isMethod('post')) {
            $result = $this->orderRequestService->saveRequestMessage($request);
            return redirect()->back()->with($result['status'], $result['message']);
        }
        return view('requests.details', $this->orderRequestService->details($id));
    }

    public function requestAccept(OrderRequestAcceptRequest $request)
    {
        $result = $this->orderRequestService->actionOnRequest($request);
        return redirect()->back()->with($result['status'], $result['message']);
    }
}

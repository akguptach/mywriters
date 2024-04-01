<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderRequestService;
use App\Http\Requests\OrderRequestAcceptRequest;

class OrderRequestController extends Controller
{


    public function __construct(protected OrderRequestService $orderRequestService)
    {
    }

    public function pending()
    {
        return view('requests.pending', $this->orderRequestService->pending());
    }

    public function details($id)
    {
        return view('requests.details', $this->orderRequestService->details($id));
    }

    public function requestAccept(OrderRequestAcceptRequest $request)
    {
        $result = $this->orderRequestService->actionOnRequest($request);
        return redirect('request_details', [$result['data']->id])->with($result['status'], $result['message']);
    }
}

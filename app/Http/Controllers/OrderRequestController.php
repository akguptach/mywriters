<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderRequestService;
use App\Http\Requests\OrderRequestAcceptRequest;
use App\Http\Requests\OrderRequestMessageRequest;
use App\Http\Requests\FinalBudgetRequest;
use App\Http\Requests\SubmitFinalDocumentRequest;

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
        if ($request->exists('ACCEPT')) {
            return redirect()->back()->with($result['status'], $result['message']);
        } else {
            return redirect()->route('pending_request', ['type' => $result['data']->type])->with($result['status'], $result['message']);
        }
    }

    public function submitFinalBudget(FinalBudgetRequest $request, $id)
    {
        $result = $this->orderRequestService->submitFinalBudget($request);
        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function submitFinalDocument(SubmitFinalDocumentRequest $request, $id)
    {
        $result = $this->orderRequestService->submitFinalDocument($request, $id);
        return redirect()->back()->with($result['status'], $result['message']);
    }
}

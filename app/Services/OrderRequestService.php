<?php

namespace App\Services;

use App\Models\OrderRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderService.
 */
class OrderRequestService
{
    public function pending()
    {
        $userId = Auth::user()->id;
        $orderRequests = OrderRequest::with(['order', 'order.lavelStudy', 'order.referencingStyle', 'order.grade'])
            ->where('tutor_id', $userId)
            ->where('status', 'PENDING')
            ->where('type', 'TUTOR')
            ->get();
        return ['orderRequests' => $orderRequests];
    }

    public function details($id)
    {
        $userId = Auth::user()->id;
        $orderRequest = OrderRequest::with([
            'order',
            'order.lavelStudy',
            'order.referencingStyle',
            'order.grade',
            'order.website',
            'order.subject'
        ])
            ->where('order_id', $id)
            ->where('tutor_id', $userId)
            ->first();
        return ['orderRequest' => $orderRequest];
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
        $orderRequest = OrderRequest::find($id);
        $orderRequest->status = 'ACCEPT';
        $orderRequest->save();
        return ['message' => 'You have successfully accepted', 'status' => 'success', 'data' => $orderRequest];
    }

    public function rejectOrderRequest($id)
    {
        $orderRequest = OrderRequest::find($id);
        $orderRequest->status = 'REJECT';
        $orderRequest->save();
        return ['message' => 'You have successfully rejected', 'status' => 'error', 'data' => $orderRequest];
    }
}

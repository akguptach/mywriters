<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NotificationService;


class NotificationController extends Controller
{

    public function __construct(protected NotificationService $notificationService)
    {
    }
    
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return $this->notificationService->getNotifications();
        }else{
            return view('notifications/index');
        }
    }

    

    
}
<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();
?>
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <!-- <li class="nav-label first">Main Menu</li> -->
            <li>
                <a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                    <i class="nav-icon fas fa-copy"></i>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>

            <li>
                <a class="ai-icon" href="{{route('account_info')}}" aria-expanded="false">
                <i class="nav-icon fas fa-user"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>


            @if($user->status == 'active')

            <li>
                <a class="ai-icon" href="{{route('account_order')}}" aria-expanded="false">
                <i class="nav-icon fas fa-user"></i>
                    <span class="nav-text">Account</span>
                </a>
            </li>

            <li>
                <a class="ai-icon" href="{{route('tutor_user.index')}}" aria-expanded="false">
                <i class="nav-icon fas fa-user"></i>
                    <span class="nav-text">User</span>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-question"></i>
                    <span class="nav-text">Order Requests</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('pending_request',['type'=>'TUTOR'])}}"><i
                                class="nav-icon fas fa-question"></i>Tutor Requests</a></li>
                    <li><a href="{{route('pending_request',['type'=>'QC'])}}"><i class="nav-icon fas fa-question"></i>QC
                            Requests</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-question"></i>
                    <span class="nav-text">Tutor Orders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('open_order',['type'=>'tutor'])}}"><i class="nav-icon fas fa-question"></i>Open
                            Orders</a></li>
                    <li><a href="{{route('completed_order',['type'=>'tutor'])}}"><i
                                class="nav-icon fas fa-columns"></i>Completed Order</a></li>
                </ul>
            </li>


            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-question"></i>
                    <span class="nav-text">QC Orders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('open_order',['type'=>'qc'])}}"><i class="nav-icon fas fa-question"></i>Open
                            Orders</a></li>
                    <li><a href="{{route('completed_order',['type'=>'qc'])}}"><i
                                class="nav-icon fas fa-columns"></i>Completed Order</a></li>
                </ul>
            </li>

            

            @endif




        </ul>


















    </div>
</div>
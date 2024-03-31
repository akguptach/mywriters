<?php
use Illuminate\Support\Facades\Auth;
use App\Models\AddressModel as Address;
use App\Models\Education;
use App\Models\Bank;
use App\Models\Tutor;
$tutor_id   =   Auth::id();
$tutors     =   Tutor::find($tutor_id);
$address    =   Address::where('tutor_id',$tutor_id)->first();
$education  =   Education::where('tutor_id',$tutor_id)->first();
$bank       =   Bank::where('tutor_id',$tutor_id)->first();
?>
<div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link  {{ ( request()->is('account_info')) ? 'active' : '' }}"  href="{{route('account_info')}}" >Account Info</a>
        </li>
        <li class="nav-item">
            @if(!empty($tutors))
                <a class="nav-link {{ ( request()->is('address')) ? 'active' : '' }}" href="{{route('address')}}" >Address</a>
            @else
                <a class="nav-link" href="javascript:void(0)" >Address</a>
            @endif
        </li>
        <li class="nav-item">
            @if(!empty($address))
                <a class="nav-link {{ ( request()->is('education')) ? 'active' : '' }}"  href="{{route('education')}}" >Education</a>
            @else
                <a class="nav-link" href="javascript:void(0)" >Education</a>
            @endif
        </li>
        <li class="nav-item">
            @if(!empty($education))
                <a class="nav-link {{ ( request()->is('bank')) ? 'active' : '' }}" href="{{route('bank')}}" >Bank</a>
            @else
                <a class="nav-link" href="javascript:void(0)" >Bank</a>
            @endif
        </li>
        <li class="nav-item">
            @if(!empty($bank))
                <a class="nav-link {{ ( request()->is('kyc')) ? 'active' : '' }}"  href="{{route('kyc')}}" >KYC</a>
            @else
                <a class="nav-link" href="javascript:void(0)" >KYC</a>
            @endif
        </li>
        </ul>
    </div>
</div>
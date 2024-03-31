<?php 
use App\Models\Tutor;
?>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{route('tutor_user.index')}}">
             Essay Help
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{route('tutor_user.index')}}">
           Essay Help
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <?php $tuto_id            =   Auth::id();
        $tutors     =   Tutor::find($tuto_id);?>
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{$tutors->tutor_first_name}} {{$tutors->tutor_last_name}}</span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
        
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="ti-settings"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <?php /*<a class="dropdown-item" href="{{route('account_info')}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2" ></i> Account Info</a>
                <a class="dropdown-item" href="{{route('address')}}"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2" ></i> Address</a>
                <a class="dropdown-item" href="{{route('education')}}"><i class="dropdown-item-icon mdi mdi-calendar-text-outline text-primary me-2" ></i> Education</a>
                <a class="dropdown-item" href="{{route('bank')}}"><i class="dropdown-item-icon mdi mdi-bank-outline text-primary me-2" ></i>  Bank</a>
                <a class="dropdown-item" href="{{route('kyc')}}"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2" ></i>  KYC</a>*/?>
                <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2" ></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
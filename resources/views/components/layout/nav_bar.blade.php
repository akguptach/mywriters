<?php 
use App\Models\Tutor;
?>
<style>
.button__badge {
    background-color: #fa3e3e;
    border-radius: 2px;
    color: white;
    padding: 0px 4px;
    font-size: 10px;
    position: absolute;
    top: -7%;
    right: 8%;
}
</style>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{route('tutor_user.index')}}">
                My Writers
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{route('tutor_user.index')}}">
                My Writers
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <?php $tuto_id            =   Auth::id();
        $tutors     =   Tutor::find($tuto_id);?>
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{$tutors->tutor_first_name}}
                        {{$tutors->tutor_last_name}}</span></h1>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @php( $teacherOrderReqMessages =
            \App\Models\OrderRequestMessage::with(['sendertable'])
            ->select()->addSelect(\DB::raw("CONCAT(UNIX_TIMESTAMP((created_at)), '000000') as date"))
            ->addSelect(\DB::raw('CONCAT("/request/details/", request_id) as route'))
            ->where('receivertable_id',auth()->user()->id)
            ->where('receivertable_type','App\Models\Tutor')
            ->where('read',0)
            ->get())

            

            @php( $teacherOrderMessages =
            \App\Models\TeacherOrderMessage::with(['sendertable','order.teacherAssigned'])
            ->select()->addSelect(\DB::raw("CONCAT(UNIX_TIMESTAMP((created_at)), '000000') as date"))
            ->addSelect(\DB::raw('"/open/order/details/" as route'))
            ->where('receivertable_id',auth()->user()->id)
            ->where('receivertable_type','App\Models\TUTOR')
            ->where('read',0)
            ->get())

            @php( $qcOrderMessages = \App\Models\QcOrderMessage::with(['sendertable','order.qcAssigned'])
            ->select()->addSelect(\DB::raw("CONCAT(UNIX_TIMESTAMP((created_at)), '000000') as date"))
            ->addSelect(\DB::raw('"/qc/open/order/details/" as route'))
            ->where('receivertable_id',auth()->user()->id)
            ->where('receivertable_type','App\Models\TUTOR')
            ->where('read',0)
            ->get())


            @php($combined = array_merge($teacherOrderReqMessages->toArray(), $qcOrderMessages->toArray(),$teacherOrderMessages->toArray()));
            @php(uasort($combined, function($a, $b){
              return $b['date'] - $a['date'];
            }));

            
            
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti-bell"></i>
                    <span class="button__badge">{{count($combined)}}</span>
                </a>
                @if(count($combined) > 0)
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="top: 30px;height: 400px;
    overflow: scroll;">
    
                    @foreach($combined as $message)
                    <div class="notifications-item"
                        style="padding-left : 10px;padding-right : 10px;width: 300px;border-bottom: 1px #f2f2f2 solid; ">
                        <div>{{$message['sendertable']['name']}}</div>

                        <div style="display: flex;">
                            <div class="text" style="width: 88%;word-wrap: break-word;">

                                <p>{{$message['message']}}</p>
                                <p><a href="{{$message['attachment']}}" target="_blank">{{$message['attachment']}}</a>
                                </p>
                            </div>
                            <div>
                              @if(isset($message['order']['qc_assigned']))
                                <a href="{{$message['route']}}{{$message['order']['qc_assigned']['id']}}">View</a>
                              @elseif(isset($message['order']['teacher_assigned']))
                              <a href="{{$message['route']}}{{$message['order']['teacher_assigned']['id']}}">View</a>
                              @else
                              <a href="{{$message['route']}}">View</a>
                              @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @endif
            </li>

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
                    <a class="dropdown-item" href="{{route('logout')}}"><i
                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<?php //echo "<pre>"; print_r($combined); die; ?>
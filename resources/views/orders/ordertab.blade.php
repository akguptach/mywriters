
<style> 
.nav-link.active{
    background-color: #6a73fa!important;
    color: #fff!important;
}
.nav-link{
border: 1px solid!important;
}
</style>

@if(strtoupper($type) == 'TUTOR')

<div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('request/pending/TUTOR')) ? 'active' : '' }}"
                    href="{{route('pending_request',['type'=>'TUTOR'])}}">Order Requests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('open/order/tutor')) ? 'active' : '' }}"
                    href="{{route('open_order',['type'=>'tutor'])}}">Open Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('completed/order/tutor')) ? 'active' : '' }}"
                    href="{{route('completed_order',['type'=>'tutor'])}}">Completed Orders</a>
            </li>

        </ul>
    </div>
</div>
@elseif(strtoupper($type) == 'QC')
<div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('request/pending/QC')) ? 'active' : '' }}"
                    href="{{route('pending_request',['type'=>'QC'])}}">Order Requests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('open/order/qc')) ? 'active' : '' }}"
                    href="{{route('open_order',['type'=>'qc'])}}">Open Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('completed/order/qc')) ? 'active' : '' }}"
                    href="{{route('completed_order',['type'=>'qc'])}}">Completed Orders</a>
            </li>

        </ul>
    </div>
</div>

@endif
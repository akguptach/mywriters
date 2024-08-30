
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

<div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('account_info')) ? 'active' : '' }}"
                    href="{{route('account_info')}}">Order Requests</a>
            </li>
        </ul>
    </div>
</div>
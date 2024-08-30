<style> 
.nav-link.active{
    background-color: #6a73fa!important;
    color: #fff!important;
}
.nav-link{
border: 1px solid!important;
}
</style>
<div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link  {{ ( request()->is('account_order')) ? 'active' : '' }}"
                    href="{{route('account_order')}}">Completed Orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ( request()->is('withdraw')) ? 'active' : '' }}" href="{{route('withdraw')}}">Withdraw</a>
            </li>
        </ul>
    </div>
</div>
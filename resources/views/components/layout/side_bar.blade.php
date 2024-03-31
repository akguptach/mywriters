<?php  
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
<!-- partial -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="menu-icon mdi mdi-grid-large "></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('account_info')}}">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">Profile</span>
        </a>
      </li>
    @if($user->status == 'active')
      <li class="nav-item">
        <a class="nav-link" href="{{route('tutor_user.index')}}">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">User</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#orders_div" aria-expanded="false" aria-controls="orders_div">
          <i class="menu-icon mdi mdi-table"></i>
          <span class="menu-title">Orders</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="orders_div">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('open_order')}}">Open Order</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('completed_order')}}">Completed Order</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('account_order')}}">Account</a></li>
          </ul>
        </div>
      </li>
    @endif
  </ul>
</nav>
<!-- partial -->
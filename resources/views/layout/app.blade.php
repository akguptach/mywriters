<x-layout.header />
<div class="container-scroller">
    <x-layout.nav_bar/>
    <div class="container-fluid page-body-wrapper">
        <x-layout.side_bar/>
        <div class="main-panel">
        <x-layout.script/>
            @yield('content')
            <x-layout.footer/>
        </div>
    </div>
</div>


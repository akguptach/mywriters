@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                        @include('orders.account_tab')
                            <div class="card card-primary">
                                
                            <div class="card-body">
                                            <h4 class="card-title">Withdraw</h4>
                                            <div class="table-responsive">
                                            </div>
                                        </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</div>
</div>

@endsection
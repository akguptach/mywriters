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
                                            <h4 class="card-title">Account</h4>
                                            <h6>Total Earning: ${{$total}}</h6>
                                            <br>
                                            <div class="table-responsive">
                                            <table class="table" id="example1">
                                                <thead>
                                                <tr>
                                                    <th>Task code</th>
                                                    <th>Order Date</th>
                                                    <th>Earning</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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
<script>
    
$(document).ready(function() {
    
    var table = $('#example1').DataTable({
        searching:false,
        processing: true,
        serverSide: true,
        ajax: "{{ route('account_order') }}",
        columns: [
            {
                data: 'order_id'
            },
            {
                data: 'created_at'
            },
            {
                data: 'earn'
            },
        ]

    });

    

});
</script>
@endsection
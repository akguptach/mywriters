@extends('layout.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    @include('orders.account_tab')
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Withdraw History</h4>
                            <div class="table-responsive">
                                <table class="table" id="withdraw_request_table">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Request Amount</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
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
    </div>
    <script>
    $(document).ready(function() {
        var table = $('#withdraw_request_table').DataTable({
            dom: '<"top-toolbar"lf>rtip',
            initComplete: function() {
                this.api().columns([3]).every(function() {
                    var column = this;
                    var website_type = $('#status')
                        .on('change', function() {
                            var val = $(this).val();
                            column.search(val).draw();
                        });

                });
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('payment.withdraw.history') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'amount'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'status'
                },
                {
                    data: 'remarks'
                }

            ]

        });
        $("div.top-toolbar").css({
            "display": "flex",
            "justify-content": "space-between"
        });

        $("div.top-toolbar").append(
            '<select id="status"><option value="">All</option><option value="COMPLETED">Completed</option><option value="PENDING">Pending</option><option value="DECLINED">Declined</option></select>'
            );
    });
    </script>
    @endsection
@extends('layout.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Notifications</h4>
                            <div class="table-responsive">
                                <table class="table" id="notification_table">
                                    <thead>
                                        <tr>
                                            <th>Order id</th>
                                            <th>Sender</th>
                                            <th>Message</th>
                                            <th>Receiver</th>
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
        var table = $('#notification_table').DataTable({
            //dom: '<"top-toolbar"lf>rtip',
            dom:'ltrip',
            processing: true,
            serverSide: true,
            ajax: "{{url()->full()}}",
            columns: [
                {
                    data: 'order_id'
                },
                {
                    data: 'sender'
                },
                {
                    data: 'message'
                },
                {
                    data: 'receiver'
                }

            ]

        });
        
    });
    </script>
    @endsection
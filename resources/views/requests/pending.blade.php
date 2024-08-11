@extends('layout.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders Requests</h4>
                            <div class="table-responsive">
                                <table class="table" id="pending_requests" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Task code</th>
                                            <th>Order date</th>
                                            <th>Level of study</th>
                                            <th>Order type</th>
                                            <th>Referncing Style</th>
                                            <th>Status</th>
                                            <th>Word count</th>
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
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {

    var table = $('#pending_requests').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('pending_request',$type) }}",

        columns: [

            {
                data: function(data) {
                    return `<a style="color:blue;" href="${APP_URL}request/details/${data.id}">${data.order.website.order_prefix}${data.order.id}</a>`;
                },
                name:'id'
            },

            {
                data: function(data) {
                    return `<a style="color:blue;" href="${APP_URL}request/details/${data.id}">${moment(data.order.created_at).format('MM/DD/YYYY')}</a>`;
                },
                name:'created_at'
            },
            {
                data: function(data) {
                    return data.order.lavel_study.level_name;
                },
                name:'level_name'
            },
            {
                data: function(data) {
                    return data.order.task_type.type_name;
                },
                name:'type_name'
            },
            {
                data: function(data) {
                    return data.order.referencing_style.style;
                },
                name:'style'
            },
            {
                data: 'status',
                name:'status'
            },
            {
                data: function(data) {
                    return data.order.no_of_words;
                },
                name:'no_of_words'
            },

            // Define more columns as per your table structure

        ]

    });

    

});
</script>

@endsection
@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="float-right" style="float:right">
                    <a href="{{ route('tutor_user.create') }}" style="text-decoration:none;color:black">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add
                    </a>
                </div>
                <h4 class="card-title">Users</h4>
                <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Action</th>
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

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
    $('#example1').DataTable( {
				 "columns": [
                { data: "first_name" },
                { data: "last_name" },
                { data: "email" },
                { data: "action" }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('tutor_user');;?>"
    } );
  });
  function delete_user(msg,id){
        if(confirm(msg)){
            var form = $('#user_form_'+id);
            var token = $('#csrf_'+id).val();
            // Create a hidden input field to send the CSRF token
            var csrfInput = $('<input>')
                .attr('type', 'hidden')
                .attr('name', '_token')
                .val(token);
            // Create a hidden input field to send the DELETE method
            var methodInput = $('<input>')
                .attr('type', 'hidden')
                .attr('name', '_method')
                .val('DELETE');
            // Append the hidden input fields to the form
            form.append(csrfInput, methodInput);
            // Submit the form
            form.submit();
        }
    }
</script>
@endsection
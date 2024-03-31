@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12">
        <x-accounttab/>

            <div class="card">
            <div class="card-body">
                <h4 class="card-title">KYC</h4>
                @if (session('status'))
                    <div class="alert alert-success"  id="success_message">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="forms-sample" id="quickForm" method="POST" action="{{route('kyc')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label >Id proof</label>
                        <input type="file" class="form-control" name="id_proof" >
                        @if(!empty($kyc->id_proof))
                        <a href="<?= asset($kyc->id_proof);?>" target="_blank">View</a>

                        @endif
                        @error('id_proof')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Address proof</label>
                        <input type="file" class="form-control" name="address_proof" >
                        @if(!empty($kyc->address_proof))
                        <a href="<?= asset($kyc->address_proof);?>" target="_blank">View</a>

                        @endif
                        @error('address_proof')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
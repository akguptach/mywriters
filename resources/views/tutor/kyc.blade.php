@extends('layout.app')
@section('content')

<?php
function validImage($file) {
    $size = getimagesize($file);
    if(isset($size['mime']))
        return (strtolower(substr($size['mime'], 0, 5)) == 'image' ? true : false); 
    else
        return false;
 }
 ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <x-accounttab />

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">k<small>yc</small></h3>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="quickForm" method="POST" action="{{route('kyc')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="id_proof">Id proof
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" class="form-control" name="id_proof"
                                                            required>
                                                        @if(!empty($kyc->id_proof))
                                                        <?php /*<a href="<?= asset($kyc->id_proof); ?>"
                                                        target="_blank">View</a>*/ ?>
                                                        @endif
                                                        @error('id_proof')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if(!empty($kyc->id_proof))
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="id_proof"></label>
                                                    <div class="col-lg-6">
                                                    <p><a href="<?= asset($kyc->id_proof); ?>"
                                                    target="_blank">View</a></p>
                                                        @if(validImage(asset($kyc->id_proof)))
                                                        <a href="<?= asset($kyc->id_proof); ?>" target="_blank">
                                                            <img src="{{$kyc->id_proof}}" width="250px">
                                                        </a>
                                                        @else
                                                        
                                                        <object data="{{$kyc->id_proof}}" type="application/pdf" width="100%"
                                                            height="100%">
                                                            
                                                        </object>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif

                                                <?php /* <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="address_proof">Address proof
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" class="form-control" name="address_proof" required>
                                                        @if(!empty($kyc->address_proof))
                                                        <a href="<?= asset($kyc->address_proof); ?>"
                                                target="_blank">View</a>

                                                @endif
                                                @error('address_proof')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        */ ?>

                                    </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save and continue</button>
                            <!-- <a href="" class="btn btn-primary">Back</a> -->
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    </section>
</div>
</div>
</div>
@endsection
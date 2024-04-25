<div class="col-md-4">
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">Order Details</h3>
            <p>&nbsp;</p>
            <?php /*<p class="text-muted text-center">{{$orderRequest->order->student->first_name.' '.$orderRequest->order->student->last_name}}</p>*/ ?>
            <ul class="list-group list-group-unbordered mb-3">
                <?php /*<li class="list-group-item">
                    <b>Website</b> <a class="float-right">{{$orderRequest->order->website->website_name}}</a>
                </li>*/ ?>
                <li class="list-group-item">
                    <b>Subject</b> <a class="float-right">{{$orderRequest->order->subject->subject_name}}</a>
                </li>
                <li class="list-group-item">
                    <b>No Of Words</b> <a class="float-right">{{$orderRequest->order->no_of_words}}</a>
                </li>
                <li class="list-group-item">
                    <b>Delivery Date</b> <a class="float-right">{{$orderRequest->order->delivery_date}}</a>
                </li>

                @if($orderAssign && $orderAssign->status == 'COMPLETED')
                <li class="list-group-item">
                    <b>Teacher's Attachment</b>
                    <div><a class="float-right" href="{{$orderRequest->order->fileupload}}" target="_blank"
                            href="{{$orderAssign->attachment}}">{{$orderAssign->attachment}}</a></div>
                </li>
                @endif

                <li class="list-group-item">
                    <b>Student's Attachment</b>
                    <div><a class="float-right" href="{{$orderRequest->order->fileupload}}"
                            target="_blank">{{$orderRequest->order->fileupload}}</a></div>
                </li>

                @if($qcAssign && $qcAssign->status == 'COMPLETED')
                <li class="list-group-item">
                    <b>Qc's Attachment</b>
                    <div><a class="float-right" href="{{$orderRequest->order->fileupload}}" target="_blank"
                            href="{{$orderAssign->attachment}}">{{$qcAssign->attachment}}</a></div>
                </li>
                @endif
            </ul>



            @if($type == 'TUTOR')
            <h5 class="text-center">
                @if($orderAssign && $orderAssign->status == 'COMPLETED')
                Completed
                @elseif($orderAssign || $qcAssign)
                Assigned
                @elseif($orderRequest->status == 'ACCEPTED')
                Accepted
                @endif
            </h5>
            @endif

            @if($type == 'QC')
            <h5 class="text-center">
                @if($qcAssign && $qcAssign->status == 'COMPLETED')
                Completed
                @elseif($qcAssign->status == 'PENDING')
                Assigned
                @elseif($orderRequest->status == 'ACCEPTED')
                Accepted
                @endif
            </h5>
            @endif




            <!--<a href="#" class="btn btn-block btn-success btn-lg"><b>Approved</b></a>-->
        </div>
    </div>
</div>
<style>
.direct-chat-text .list-group-item{
    background: #fff;
}
</style>
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
                    <b>Referencing Style</b> <a
                        class="float-right">{{$orderRequest->order?->referencingStyle?->style}}</a>
                </li>

                <li class="list-group-item">
                    <b>Task type</b> <a class="float-right">{{$orderRequest->order?->taskType?->type_name}}</a>
                </li>

                <li class="list-group-item">
                    <b>Level of study</b> <a class="float-right">{{$orderRequest->order?->lavelStudy?->level_name}}</a>
                </li>

                <li class="list-group-item">
                    <b>Grade required</b> <a class="float-right">{{$orderRequest->order?->grade?->grade_name}}</a>
                </li>

                @if($orderRequest->order?->teacherAssigned)
                <li class="list-group-item">
                    <b>Tutor Budget</b> <a
                        class="float-right">{{$orderRequest->order?->currency_code}}{{$orderRequest->order?->teacherAssigned->tutor_price}}</a>
                </li>
                @endif






                <li class="list-group-item">
                    <b>No Of Words</b> <a class="float-right">{{$orderRequest->order->no_of_words}}</a>
                </li>
                <li class="list-group-item">
                    <b>Delivery Date</b> <a class="float-right">{{$orderRequest->order->delivery_date}}</a>
                </li>

                @if($orderAssign && $orderAssign->status == 'COMPLETED')
                @include('components.download_link',
                    [
                    'attachment'=>$orderRequest->order->fileupload,
                    'attachmentTitle'=>"Teacher's Attachment"
                    ])
                @endif

                @include('components.download_link',
                    [
                    'attachment'=>$orderRequest->order->fileupload,
                    'attachmentTitle'=>"Student's Attachment"
                    ])

                @if(@$qcAssign && $qcAssign->status == 'COMPLETED')
                    @include('components.download_link',
                    [
                    'attachment'=>$orderRequest->order->fileupload,
                    'attachmentTitle'=>"Qc's Attachment"
                    ])
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
                @if(@$qcAssign && $qcAssign->status == 'COMPLETED')
                Completed
                @elseif(@$qcAssign->status == 'PENDING')
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
<h4 class="card-title">Pending Request</h4>

<div class="table-responsive">
    <table class="table" id="example1">
        <tbody>
            <?php /*<tr>
                <td>Website</td>
                <td>{{$orderRequest->order->website->website_name}}</td>
            </tr>*/ ?>
            <tr>
                <td>Subject</td>
                <td>{{$orderRequest->order->subject->subject_name}}</td>
            </tr>

            <tr>
                <td>Subject</td>
                <td>{{$orderRequest->order->subject->subject_name}}</td>
            </tr>


            <tr>
                            <td>Referencing Style:</td>
                            <td id="summary_referencing_style">{{$orderRequest?->order?->referencingStyle?->style}}</td>
                        </tr>




                        <tr>
                            <td>Task type:</td>
                            <td id="summary_task_type">{{$orderRequest?->order?->taskType?->type_name}}</td>
                        </tr>


                        <tr>
                            <td>Level of study</td>
                            <td id="summary_level_of_study">{{$orderRequest?->order?->lavelStudy?->level_name}}</td>
                        </tr>



                        <tr>
                            <td>Grade required</td>
                            <td id="summary_grade_required">{{$orderRequest?->order?->grade?->grade_name}}</td>
                        </tr>



            <tr>

                <td>No Of Words</td>
                <td>{{$orderRequest->order->no_of_words}}</td>
            </tr>
            <tr>
                <td>Delivery Date</td>
                <td>{{$orderRequest->order->delivery_date}}</td>
            </tr>
            <tr>
                <td>Attachment</td>
                <td><a href="{{$orderRequest->order->fileupload}}">{{$orderRequest->order->fileupload}}</a></td>
            </tr>
            <tr>
                <td>
                    <form action="{{route('request_accept')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$orderRequest->id}}" name="id">
                        @error('id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" name="ACCEPT" class="btn btn-primary me-2">Accept</button>
                        <button type="submit" name="REJECT" class="btn btn-danger me-2">Reject</button>
                    </form>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

</div>
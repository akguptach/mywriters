<div class="row">
    @include('requests.order_info',['orderRequest'=>$orderRequest])
    <div class="col-md-8">
        <div class="card1">
            <!--<div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{$orderRequest->type}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">QC</a></li>
                </ul>
            </div>-->

            <div class="card card-primary card-outline direct-chat direct-chat-primary">
                <div class="card-header1">
                    <p class="text-muted text-left"></p>
                </div>
                <!-- /.card-header -->


                <div class="card-body">
                    <p class="text-muted text-center"><b>{{$orderRequest->teacher->tutor_first_name}}</b></p>
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        @foreach ($orderMessage as $item)

                        @if ($item->sendertable_type== 'App\Models\Tutor')
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">{{$item->sendertable->tutor_first_name}}</span>
                                <span class="direct-chat-timestamp float-right">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img style="border: 1px solid;" class="direct-chat-img" src="{{ asset('images/avatar.png') }}" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                {{$item['message']}}
                                <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->

                        @else


                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">{{$item['sendertable']['name']}}</span>
                                <span class="direct-chat-timestamp float-left">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="{{ asset('images/avatar5.png') }}" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                {{$item['message']}}
                                <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="attachment" id="attachment" style="display: none;" />
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <a class="btn btn-info btn-sm" href="javascript::void(0);" onclick="document.getElementById('attachment').click()" value="Select a File" style="margin-left: 10px;border-radius: 6px;font-size: 13px;">
                                    <span class="mdi mdi-attachment"></span>

                                </a>
                                <input type="hidden" name="order_id" value="{{$orderRequest->order_id}}" />
                                <input type="hidden" name="type" value="{{$orderRequest->type}}" />
                                <button name="ORDER" type="submit" class="btn btn-primary" style="height: 33px;padding: 8px;">Send</button>
                            </span>
                        </div>
                    </form>
                </div>

                @if($orderRequest->type == 'TUTOR' && $orderAssign && $orderAssign->status == 'PENDING')
                <div class="card-footer">
                    <form method="POST" action="{{route('submit_final',['id'=>$orderRequest->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            &nbsp;
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedBudget">Upload attachment</label>
                            <input type="file" id="inputEstimatedBudget" class="form-control" name="attachment" style="    height: 100%;">
                            @error('attachment')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="submit" name="complete_order" value="Complete" class="btn btn-success float-right">
                    </form>
                </div>
                @endif




            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
</div>
<style>
    .direct-chat .card-body {
        overflow-x: hidden;
        padding: 0;
        position: relative;
    }

    .direct-chat.chat-pane-open .direct-chat-contacts {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .direct-chat.timestamp-light .direct-chat-timestamp {
        color: #30465f;
    }

    .direct-chat.timestamp-dark .direct-chat-timestamp {
        color: #ccc;
    }

    .direct-chat-messages {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
        height: 250px;
        overflow: auto;
        padding: 10px;
    }

    .direct-chat-msg,
    .direct-chat-text {
        display: block;
    }

    .direct-chat-msg {
        margin-bottom: 10px;
    }

    .direct-chat-msg::after {
        display: block;
        clear: both;
        content: "";
    }

    .direct-chat-contacts,
    .direct-chat-messages {
        transition: -webkit-transform 0.5s ease-in-out;
        transition: transform 0.5s ease-in-out;
        transition: transform 0.5s ease-in-out, -webkit-transform 0.5s ease-in-out;
    }

    .direct-chat-text {
        border-radius: 0.3rem;
        background-color: #d2d6de;
        border: 1px solid #d2d6de;
        color: #444;
        margin: 5px 0 0 50px;
        padding: 5px 10px;
        position: relative;
    }

    .direct-chat-text::after,
    .direct-chat-text::before {
        border: solid transparent;
        border-right-color: #d2d6de;
        content: " ";
        height: 0;
        pointer-events: none;
        position: absolute;
        right: 100%;
        top: 15px;
        width: 0;
    }

    .direct-chat-text::after {
        border-width: 5px;
        margin-top: -5px;
    }

    .direct-chat-text::before {
        border-width: 6px;
        margin-top: -6px;
    }

    .right .direct-chat-text {
        margin-left: 0;
        margin-right: 50px;
    }

    .right .direct-chat-text::after,
    .right .direct-chat-text::before {
        border-left-color: #d2d6de;
        border-right-color: transparent;
        left: 100%;
        right: auto;
    }

    .direct-chat-img {
        border-radius: 50%;
        float: left;
        height: 40px;
        width: 40px;
    }

    .right .direct-chat-img {
        float: right;
    }

    .direct-chat-infos {
        display: block;
        font-size: 0.875rem;
        margin-bottom: 2px;
    }

    .direct-chat-name {
        font-weight: 600;
    }

    .direct-chat-timestamp {
        color: #697582;
    }

    .direct-chat-contacts-open .direct-chat-contacts {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .direct-chat-contacts {
        -webkit-transform: translate(101%, 0);
        transform: translate(101%, 0);
        background-color: #343a40;
        bottom: 0;
        color: #fff;
        height: 250px;
        overflow: auto;
        position: absolute;
        top: 0;
        width: 100%;
    }

    .direct-chat-contacts-light {
        background-color: #f8f9fa;
    }

    .direct-chat-contacts-light .contacts-list-name {
        color: #495057;
    }

    .direct-chat-contacts-light .contacts-list-date {
        color: #6c757d;
    }

    .direct-chat-contacts-light .contacts-list-msg {
        color: #545b62;
    }
</style>
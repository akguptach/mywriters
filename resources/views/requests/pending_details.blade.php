<h4 class="card-title">Pending Request</h4>

<div class="table-responsive">
    <table class="table" id="example1">
        <tbody>
            <tr>
                <td>Website</td>
                <td>{{$orderRequest->order->website->website_name}}</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>{{$orderRequest->order->subject->subject_name}}</td>
            </tr>
            <tr>

                <td>No Of Words</td>
                <td>{{$orderRequest->order->no_of_words}}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{{$orderRequest->order->price}}</td>
            </tr>
            <tr>
                <td>Currency</td>
                <td>{{$orderRequest->order->currency_code}}</td>
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
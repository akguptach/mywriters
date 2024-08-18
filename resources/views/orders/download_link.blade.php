@if($attachment)
<li class="list-group-item1">
    <b>{{$attachmentTitle}}</b>
    @php($isjsonArray = json_decode($attachment,true))
        @if($isjsonArray)
        <ul>
            @foreach($isjsonArray as $item)
                <li>
                    <div>
                        <a target="_blank" class="float-right1" href="{{$item['url']}}" style="overflow-wrap: anywhere;"><i class='fas fa-file-download'></i> View attachment</a>
                    </div>
                </li>
            @endforeach
        <ul>
        @else
        <ul>
            <li>

                <p><a target="_blank" class="float-right1" href="{{$attachment}}" style="overflow-wrap: anywhere;"><i class='fas fa-file-download'></i> View attachment</a></p>
            </li>
        </ul>
        @endif
</li>
@endif
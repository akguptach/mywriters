@if($attachment)

<li class="list-group-item">
    <b>{{$attachmentTitle}}</b>
    @php($isjsonArray = json_decode($attachment,true))


    @if($isjsonArray)

    <ul>
        @foreach($isjsonArray as $item)
        @php($url=$item['url'])
        <li>
            <div>
                <a onclick="downloadFromUrl('{{$url}}')" target="_blank" class="float-right1 download-attachment"
                    href="{{$item['url']}}" style="overflow-wrap: anywhere;"><i class='fas fa-file-download' style="font-size: 30px;"></i>
                    View attachment</a>
            </div>
        </li>
        @endforeach
    </ul>
    @else
    <ul>
        <li>
            <p><a onclick="downloadFromUrl('{{$attachment}}')" target="_blank" class="float-right1 download-attachment"
                    href="{{$attachment}}" style="overflow-wrap: anywhere;"><i class='fas fa-file-download'
                        style="font-size: 30px;"></i>
                    <span style="vertical-align: super;">View attachment</span></a></p>
        </li>
    </ul>
    @endif
</li>
@endif
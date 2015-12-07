@foreach ($items as $i => $item)
    <tr>
        @foreach($tbody as $key => $value)
            <td class="{{$value['class']}}">
                @if($key == 'tags')
                    {{--*/ $tags = explode(',',$item[$key]); /*--}}
                    @foreach($tags as $tag)
                        <label class="label label-default">{{ $tag }}</label>
                    @endforeach
                @elseif($key == 'estado')
                    @if($item[$key] == 1)
                        <label class="label label-primary">Activo</label>
                    @else
                        <label class="label label-default">Inactivo</label>
                    @endif
                @else
                    {{$item[$key]}}
                @endif
            </td>
        @endforeach
        <td>
            @include(Config::get('htmlext::views.buttons'))
        </td>
    </tr>
@endforeach

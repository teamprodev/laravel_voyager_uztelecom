<div class='row'>
    @foreach($data as $key => $elem)
    <a style='background-color: {{setting("color.{$key}")}};color: {{setting('color.' . $key) ? 'white' : 'black'}}'
       href='{{$elem}}' class='m-1 col edit btn btn-sm' {{$key === 'destroy' ? "onclick='return confirm(`$confirm`)'" : ''}}>{{__($key)}}</a>
    @endforeach
</div>

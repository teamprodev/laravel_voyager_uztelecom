<div class='row'>
    @foreach($data as $key => $elem)
    <a style='background-color: {{setting("color.{$key}")}};color: {{setting('color.' . _($key)) ? 'white' : 'black'}}'
       href='{{$elem}}' class='m-1 col edit btn btn-sm' {{$key === 'destroy' ? "onclick='return confirm(`$confirm`)'" : ''}}>$key</a>
    @endforeach
</div>

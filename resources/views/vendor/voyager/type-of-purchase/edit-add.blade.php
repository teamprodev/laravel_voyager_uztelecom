@extends('voyager::master')
@section('content')
        <!-- PUT Method if we are editing -->
{{ Aire::open()
  ->route('type-of-purchase.update')
  ->enctype("multipart/form-data")
  ->post() }}
        <!-- CSRF TOKEN -->
        <div class="panel-body">


            <!-- Adding / Editing -->

            <!-- GET THE DISPLAY OPTIONS -->

            <div class="form-group  col-md-12 ">

                <label class="control-label" for="name">Name Ru</label>
                <input type="text" class="form-control" name="nameRu" placeholder="Name Ru" value="{{$purchase->getTranslation('name','ru')}}">
                <label class="control-label" for="name">Name Uz</label>
                <input type="text" class="form-control" name="nameUz" placeholder="Name Uz" value="{{$purchase->getTranslation('name','uz')}}">
                <label class="control-label" for="name">Name En</label>
                <input type="text" class="form-control" name="nameEn" placeholder="Name En" value="{{$purchase->getTranslation('name','en')}}">
            </div>
            @if(isset($purchase))
            <input type="text" class="hidden" name="purchase_id" value="{{$purchase->id}}">
            @endif
        </div><!-- panel-body -->

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary save">Сохранить</button>
        </div>
    {{ Aire::close() }}
@endsection

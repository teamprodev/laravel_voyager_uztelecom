@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <a href="/" class="btn btn-danger">{{ __('Назад') }}</a>
    </div>
    @if($application->user_id == auth()->user()->id)
    {{ Aire::open()
  ->route('site.applications.is_more_than_limit',$application->id)
  ->enctype("multipart/form-data")
  ->post() }}
    <div class="container">
        @if($application->is_more_than_limit == 1)
        {{ Aire::submit(__("Компания"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('1') }}
        @else
            {{ Aire::submit(__("Компания"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('1') }}
        @endif
        @if($application->is_more_than_limit == '0')
        {{ Aire::submit(__("Филиал"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('0') }}
            @else
            {{ Aire::submit(__("Филиал"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('0') }}
            @endif
    </div>
    {{ Aire::close() }}
    @endif
    @if($application->performer_role_id == auth()->user()->role_id)
        @if($performer_file != 'null' && $performer_file != null)
            <div class="mb-5" style="width: 100%;padding-left: 700px;">
                @foreach($performer_file as $file)
                    @if(file_exists(public_path()."/storage/uploads/{$file}"))
                    <h4 class="text-left">Performer File</h4>
                    <form action="/delete_file/{{$application->id}}/performer_file" method="post">
                        @csrf
                        <input type="text" class="hidden" value="{{$file}}" name="file">
                        @if(\Illuminate\Support\Str::contains($file,'jpg')||\Illuminate\Support\Str::contains($file,'png')||\Illuminate\Support\Str::contains($file,'svg'))
                            <img src="/storage/uploads/{{$file}}" width="500" height="500" alt="not found">
                            @if($application->performer_role_id == auth()->user()->role_id)
                                <button class='mbtn btn-sm btn-danger'>{{__('Удалить')}}</button>
                            @endif
                        @else
                            <div class="d-flex align-items-center" style="column-gap: 10px">
                                <button type="button" class="btn btn-primary"><input type="text" class="hidden" value="{{$file}}" name="file" required/><a style="color: white;" href="/storage/uploads/{{$file}}">{{preg_replace('/[0-9]+_/', '', $file)}}</a></button>
                                @if($application->performer_role_id == auth()->user()->role_id)
                                    <button style="text-align: center" class='mbtn btn-sm btn-danger'>{{__('Удалить')}}</button>
                                @endif
                            </div>
                            <p class="my-2">{{preg_replace('/[0-9]+_/', '', $file)}}</p>
                        @endif
                    </form>
                    @endif
                @endforeach
            </div>
        @endif
    @endif
    {{ Aire::open()

    ->route('site.applications.update',$application->id)
    ->enctype("multipart/form-data")
    ->post() }}
    @if($application->user_id == auth()->user()->id)
        @include('site.applications.form_edit')
    @elseif($user->hasPermission('Branch_Performer') && $application->user_id != $user->id || $user->hasPermission('Company_Performer') && $application->user_id != $user->id || $application->performer_role_id == $user->role_id)
        @include('site.applications.performer')
    @elseif($user->hasPermission('Warehouse') && $application->status == 'Принята'||$user->hasPermission('Warehouse') && $application->status == 'товар доставлен'||$user->hasPermission('Warehouse') && $application->status == 'товар прибыл')
        @include('site.applications.warehouse')
    @endif
    {{ Aire::close() }}
@endsection


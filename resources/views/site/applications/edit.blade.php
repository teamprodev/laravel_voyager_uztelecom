@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
    </div>
    @if($application->user_id == auth()->user()->id)
    {{ Aire::open()
  ->route('site.applications.is_more_than_limit',$application->id)
  ->enctype("multipart/form-data")
  ->post() }}
    <div class="container">
        @if($application->is_more_than_limit == 1)
        {{ Aire::submit(__("Company"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('1'); }}
        @else
            {{ Aire::submit(__("Company"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('1'); }}
        @endif
        @if($application->is_more_than_limit == '0')
        {{ Aire::submit(__("Filial"))
        ->variant()->green()
        ->name('is_more_than_limit')
        ->value('0'); }}
            @else
            {{ Aire::submit(__("Filial"))
        ->variant()->gray()
        ->name('is_more_than_limit')
        ->value('0'); }}
            @endif
    </div>
    {{ Aire::close() }}
    @endif
    {{ Aire::open()
    ->route('site.applications.update',$application->id)
    ->enctype("multipart/form-data")
    ->post() }}
    @includeWhen($application->user_id == auth()->user()->id,'site.applications.form_edit')
    @includeWhen($user->hasPermission('Branch_Performer') && $application->user_id != $user->id || $user->hasPermission('Company_Performer') && $application->user_id != $user->id || $application->performer_role_id == $user->role_id ,'site.applications.performer')
    {{ Aire::close() }}
    @if($user->hasPermission('Warehouse'))
        @include('site.applications.warehouse')
    @endif
@endsection


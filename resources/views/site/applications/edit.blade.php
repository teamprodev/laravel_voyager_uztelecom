@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <a href="/" class="btn btn-danger">{{ __('Назад') }}</a>
    </div>
    @if($application->user_id == auth()->user()->id && $application->is_more_than_limit === null)
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
    @if($application->is_more_than_limit !== null)
        {{ Aire::open()

        ->route('site.applications.update',$application->id)
        ->enctype("multipart/form-data")
        ->post() }}
        @include($component)
        {{ Aire::close() }}
    @endif

@endsection


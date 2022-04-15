@extends('site.layouts.app')

@section('center_content')
    <div class="p-4">
        <button class="btn btn-danger" onclick="functionBack()">{{ __('lang.back') }}</button>
    </div>
    {{ Aire::open()
  ->route('site.applications.store')
  ->enctype("multipart/form-data")
  ->rules([
    'planned_price' => 'numeric',
    'equal_planned_price' => 'numeric|required',
    'planned_price' => 'numeric|required',
    ])
    ->messages([
    'accepted' => __('lang.terms'),
    ])
  ->post() }}
        @include('site.applications.form')
    {{ Aire::close() }}

    <script>
        function functionBack()
        {
            window.history.back();
        }
    </script>

@endsection

{{--$application->status = 1;--}}
{{--$application->role_id = $clone->role_id;--}}
{{--$application->user_id = $clone->user_id;--}}
{{--$application->pkcs = $clone->pkcs;--}}
{{--$application->text = $clone->text;--}}
{{--$application->table_name = $clone->table_name;--}}
{{--$application->application_id = $clone->application_id;--}}
{{--$application->data = $clone->data;--}}
{{--$application->comment = $clone->comment;--}}

{{--$application->save();--}}
return redirect()->back();



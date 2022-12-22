@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<div id="fortext"></div>
{{ Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post() }}
<div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
    {{Aire::select([2021 => '2021', 2022 => '2022', 2023 => '2023',2024 => '2024'], 'select', __('Год'))->value($report->where('report_key','date_10')->first()->report_value)->name('date_10')}}

    <button type="submit" class="btn btn-success" style="margin-top: 8px;">{{ __('Выбрать')  }}</button>
</div>
{{ Aire::close() }}
@if($report->where('report_key','date_10')->first()->report_value != null)
    <table id="example" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">
        <tr class="border border-dark">
            <th style="text-align: center;" class="border border-dark">{{ __('Год') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Январь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Февраль') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Март') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Апрель') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Май') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Июнь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Июль') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Август') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Сентябрь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Октябрь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Ноябрь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Декабрь') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Итого')  }}</th>
        </tr>
        </thead>
    </table>

<script>
    var columns = [
        {data: 'name', name: 'name'},
        {data: 'january', name: 'january'},
        {data: 'february', name: 'february'},
        {data: 'march', name: 'march'},
        {data: 'april', name: 'april'},
        {data: 'may', name: 'may'},
        {data: 'june', name: 'june'},
        {data: 'july', name: 'july'},
        {data: 'august', name: 'august'},
        {data: 'september', name: 'september'},
        {data: 'october', name: 'october'},
        {data: 'november', name: 'november'},
        {data: 'december', name: 'december'},
        {data: 'all', name: 'all'},
    ];
</script>
@endif
<x-laravelYajra getData="{{ route('report','10') }}" tableTitle="{{__('10 - Отчет по кол-ву статусам')}}"/>
@endsection

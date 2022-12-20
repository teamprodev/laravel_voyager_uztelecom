@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<div id="fortext"></div>
{{ Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post() }}
<div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
    {{Aire::select([2021 => '2021', 2022 => '2022', 2023 => '2023',2024 => '2024'], 'select', __('Год'))->value($report->where('report_key','date')->first()->report_value)->name('date')}}

    <button type="submit" class="btn btn-success" style="margin-top: 8px;">{{ __('Выбрать')  }}</button>
</div>
{{ Aire::close() }}
@if($report->where('report_key','date')->first()->report_value != null)
    <table id="example" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">

        <tr class="border border-dark">
            <th style="text-align: center;" class="border border-dark">{{ __('ID') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('Филиал') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('товар') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('работа') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('услуга') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('товар') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('работа') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('услуга') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('товар') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('работа') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('услуга') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('товар')}}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('работа') }}</th>
            <th style="text-align: center;" class="border border-dark">{{ __('услуга') }}</th>
        </tr>
        </thead>
    </table>

<script>
    var columns = [
        {data: "id", name: 'id'},
        {data: 'name', name: 'name'},

        {data: 'tovar_1', name: 'tovar_1'},
        {data: 'rabota_1', name: 'rabota_1'},
        {data: 'usluga_1', name: 'usluga_1'},

        {data: 'tovar_2', name: 'tovar_2'},
        {data: 'rabota_2', name: 'rabota_2'},
        {data: 'usluga_2', name: 'usluga_2'},

        {data: 'tovar_3', name: 'tovar_3'},
        {data: 'rabota_3', name: 'rabota_3'},
        {data: 'usluga_3', name: 'usluga_3'},

        {data: 'tovar_4', name: 'tovar_4'},
        {data: 'rabota_4', name: 'rabota_4'},
        {data: 'usluga_4', name: 'usluga_4'},
    ];
</script>
<x-laravelYajra getData="{{ route('report','2') }}" tableTitle="{{ __('2 - Отчет квартальный итоговый') }}"/>
@endif
@endsection

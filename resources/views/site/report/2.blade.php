@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')
    <x-laravelDateRangePicker reportId="2"  route="{{ route('site.report.index','2') }}" format="YYYY"/>
    <x-laravelYajra tableId="report2" stateSave="true" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='QBlfrtip' serverSide="true" getData="{{ route('report','2') }}" exportId="{{ route('report_export',\App\Reports\One::class) }}" tableTitle="{{ __('2 - Отчет квартальный итоговый') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}" language="ru"></x-laravelYajra>
@endsection

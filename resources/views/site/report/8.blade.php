@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="8" route="{{ route('site.report.index','8') }}"/>
<x-laravelYajra language="ru" tableId="report8" stateSave="true" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='QBlfrtip' serverSide="true" scrollX="true" getData="{{ route('report','8') }}" exportId="{{ route('report_export','8') }}" tableTitle="{{__('8 - Отчет по видам закупки')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

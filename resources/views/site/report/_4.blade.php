@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')
<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="4" route="{{ route('site.report.index','4') }}"/>
<x-laravelYajra tableId="report4" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='Blfrtip' getData="{{ route('report','4') }}" exportId="{{ route('report_export','4') }}" tableTitle="{{ __('4 - Отчет заявки по статусам') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

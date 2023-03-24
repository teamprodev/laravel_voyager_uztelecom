@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="1" route="{{ route('site.report.index','1') }}"/>
<x-laravelYajraL tableId="report1" stateSave="true" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='QBlfrtip' getData="{{ route('report','1') }}" exportId="{{ route('report_export','1') }}" tableTitle="{{ __('1 - Отчет общий') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}" language="ru"></x-laravelYajraL>
@endsection

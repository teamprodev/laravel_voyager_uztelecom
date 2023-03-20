@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')
<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="6" route="{{ route('site.report.index','6') }}"/>
<x-laravelYajraL tableId="report6" stateSave="true" dtColumns="{{$dtColumns}}" :dtHeaders=$dtHeaders dom='Blfrtip' getData="{{ route('report','6') }}" exportId="{{ route('report_export','6') }}" tableTitle="{{__('6 - Отчет свод')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

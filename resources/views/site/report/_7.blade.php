@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="7" route="{{ route('site.report.index','7') }}"/>
<x-laravelYajraL tableId="report7" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='Blfrtip' getData="{{ route('report','7') }}" exportId="{{ route('report_export','7') }}" tableTitle="{{__('7 - Плановый')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="9" route="{{ route('site.report.index','9') }}"/>
<x-laravelYajra tableId="report9" stateSave="true" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='Blfrtip' serverSide="true" getData="{{ route('report','9') }}" exportId="{{ route('report_export','9') }}" tableTitle="{{__('9 - Ойлик харидлар илова плановый')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

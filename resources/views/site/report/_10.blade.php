@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY" reportId="10" route="{{ route('site.report.index','10') }}"/>
<x-laravelYajra language="ru" tableId="report10" :dtColumns=$dtColumns :dtHeaders=$dtHeaders scrollX="true" dom='QBlfrtip' serverSide="true" getData="{{ route('report','10') }}" exportId="{{ route('report_export','10') }}" tableTitle="{{__('10 - Отчет по кол-ву статусам')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

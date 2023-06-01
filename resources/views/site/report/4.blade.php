@extends('site.layouts.app')
@section('center_content')
<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="4" route="{{ route('site.report.index','4') }}"/>
<x-laravelYajra language="ru" tableId="report4" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='QBlfrtip' serverSide="true" getData="{{ route('report','4') }}" exportId="{{\App\Exports\Reports\Four::class}}" tableTitle="{{ __('4 - Отчет заявки по статусам') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

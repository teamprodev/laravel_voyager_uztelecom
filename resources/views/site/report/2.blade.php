@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')
<x-laravelYajraLoc :dtHeaders=$dtHeaders :dtTitles=$dtTitles dom='Blfrtip' getData="{{ route('report','2') }}" exportId="{{ route('report_export','2') }}" tableTitle="{{ __('2 - Отчет квартальный итоговый') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"></x-laravelYajraLoc>
@endsection

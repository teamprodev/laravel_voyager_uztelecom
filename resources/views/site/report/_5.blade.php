@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="5" route="{{ route('site.report.index','5') }}"/>
<x-laravelYajra language="ru" tableId="report5" stateSave="true" :dtColumns=$dtColumns :dtHeaders=$dtHeaders dom='Blfrtip' getData="{{ route('report','5') }}" exportId="{{ route('report_export','5') }}" tableTitle="{{ __('5 - Отчет свод  общий') }}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
<script>
    function export_format(data, columnIdx){
        switch (columnIdx) {
            case 2:
            case 3:
                return "{{ __('Заключенные договора ') }}"  + data;
            case 4:
            case 5:
                return "{{ __('Товар ') }}"  + data;
            case 6:
            case 7:
                return "{{ __('Работа ') }}"  + data;
            case 8:
            case 9:
                return "{{ __('Услуга ') }}"  + data;
            default:
                return data;
        }
    }
</script>
@endsection

@extends('site.layouts.app')
@extends('site.layouts.report')
@section('center_content')

<x-laravelDateRangePicker format="YYYY-MM-DD" reportId="9" route="{{ route('site.report.index','9') }}"/>
<script>
    var columns = [
        {data: "id", name: 'id'},
        {data: "name", name: 'name'},

        {data: "supplier_inn", name: 'supplier_inn'},

        {data: "contract_count", name: 'contract_count'},
        {data: "contract_sum", name: 'contract_sum'},

        {data: "eshop_count", name: 'eshop_count'},
        {data: "eshop_sum", name: 'eshop_sum'},

        {data: "nat_eshop_count", name: 'nat_eshop_count'},
        {data: "nat_eshop_sum", name: 'nat_eshop_sum'},

        {data: "auction_count", name: 'auction_count'},
        {data: "auction_sum", name: 'auction_sum'},

        {data: "coop_count", name: 'coop_count'},
        {data: "coop_sum", name: 'coop_sum'},

        {data: "shaffof_count", name: 'shaffof_count'},
        {data: "shaffof_sum", name: 'shaffof_sum'},


        {data: "exchange_count", name: 'exchange_count'},
        {data: "exchange_sum", name: 'exchange_sum'},


        {data: "konkurs_count", name: 'konkurs_count'},
        {data: "konkurs_sum", name: 'konkurs_sum'},

        {data: "tender_count", name: 'tender_count'},
        {data: "tender_sum", name: 'tender_sum'},

        {data: "offers_count", name: 'offers_count'},
        {data: "offers_sum", name: 'offers_sum'},

        {data: "sole_supplier_count", name: 'sole_supplier_count'},
        {data: "sole_supplier_sum", name: 'sole_supplier_sum'},

        {data: "direct_count", name: 'direct_count'},
        {data: "direct_sum", name: 'direct_sum'},

    ];
</script>
<x-laravelYajraLoc dom='Blfrtip' getData="{{ route('report','9') }}" exportId="{{ route('report_export','9') }}" tableTitle="{{__('9 - Ойлик харидлар илова плановый')}}" startDate="{{request()->input('startDate')}}" endDate="{{request()->input('endDate')}}"/>
@endsection

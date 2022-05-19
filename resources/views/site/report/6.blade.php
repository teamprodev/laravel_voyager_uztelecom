@extends('site.layouts.app')
@section('center_content')
    <div id="section" class="pt-6">
        <a href="/" class="ml-12 btn btn-danger">{{ __('lang.back') }}</a>
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table id="yajra-datatable">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Филиал</th>
                    <th>"Контрагент (предприятия поставляющий товаров. работ. услуг)"</th>
                    <th>дата заявки</th>
                    <th>ФИО инициатора</th>
                    <th>Контактный телефон инициатора</th>
                    <th>отдел инициатора</th>
                    <th>вид закупки </th>
                    <th>Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                    <th>Предмет закупки (товар,работа,услуга)</th>
                    <th>кол-во закупаемого (товара,работа,услуги)</th>
                    <th>период</th>
                    <th>сумма заявки</th>
                    <th>С НДС?</th>
                    <th>{{__('lang.valyuta')}}</th>
                    <th>Наименование поставщика</th>
                    <th>сумма договора</th>
                    <th>Махсулот келишининг муддати</th>
                    <th>Статус</th>
                    <th>Начальник Исполнителя заявки</th>
                    <th>Исполнитель заявки</th>
                    <th>Бюджетни режалаштириш булими. Маълумот</th>
                    <th>Харидлар режасида мавжудлиги буича маълумот</th>
                    <th>{{ __('lang.table_18') }}</th>
                    <th>{{ __('lang.table_11') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#yajra-datatable').DataTable( {
                // dom: 'PQlfrtip',
                dom: 'Qlfrtip',
                ajax:
                    "{{ route('report','6') }}",

                columns: [
                    {data: "id", name: 'id'},
                    {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                    {data: 'user_id', name: 'user_id'},
                    {data: '', name: 'contact'},
                    {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                    {data: 'type_of_purchase_id', name: 'type_of_purchase_id'},
                    {data: 'name', name: 'name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'amount', name: 'amount'},
                    {data: 'expire_warranty_date', name: 'expire_warranty_date'},
                    {data: 'planned_price', name: 'planned_price'},
                    {data: 'with_nds', name: 'with_nds'},
                    {data: 'currency', name: 'currency'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'contract_price', name: 'contract_price'},
                    {data: 'delivery_date', name: 'delivery_date'},
                    {data: 'status', name: 'status'},
                    {data: 'id', name: 'id'},
                    {data: 'performer_user_id', name: 'performer_user_id'},
                    {data: 'info_business_plan', name: 'info_business_plan'},
                    {data: 'info_purchase_plan', name: 'info_purchase_plan'},
                    {data: 'purchase_basis', name: 'purchase_basis'},
                    {data: 'basis', name: 'basis'},
                ]
            });
        });
    </script>
@endsection

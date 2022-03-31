@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    {{ Aire::open()
  ->route('site.applications.update',$application->id)
  ->enctype("multipart/form-data")
  ->rules([
    'initiator' => 'required',
    'purchase_basis' => 'required',
    'specification' => 'required',
    'delivery_date' => 'required',
    'name' => 'required',
    'basis' => 'required',
    'separate_requirements' => 'required',
    'expire_warranty_date' => 'required',
    'planned_price' => 'numeric|required',
    'info_business_plan' => 'required',
    'equal_planned_price' => 'numeric|required',
    'filial_initiator_id' => 'required',
    'subject' => 'required',
    'type_of_purchase_id' => 'required',
    'info_purchase_plan' => 'required',
    'comment' => 'required',
    'filial_customer_id' => 'required',
    'lot_number' => 'required',
    'contract_number' => 'required',
    'contract_date' => 'required',
    'protocol_date' => 'required',
    'contract_info' => 'required',
    'country_produced_id' => 'required',
    'contract_price' => 'required',
    'supplier_name' => 'required',
    'supplier_inn' => 'required',
    'product_info' => 'required',
    'protocol_number' => 'required',
    ])
    ->messages([
    'accepted' => 'You must accept the terms',
    ])
  ->post() }}


    @if(auth()->user()->hasPermission('Company_Leader'))
        @include('site.applications.management_edit')
    @elseif(auth()->user()->hasPermission('Company_Performer' || 'Branch_Performer'))
            @include('site.applications.performer')
    @elseif('Branch_Leader')
            @include('site.applications.branch_management_edit')
    @else
        @include('site.applications.form_edit')
    @endif

    {{ Aire::close() }}
    <script>
        function functionBack()
        {
            window.history.back();
        }
    </script>
@endsection


@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <button class="btn btn-danger" onclick="functionBack()">{{ __('lang.back') }}</button>
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
    ])
    ->messages([
    'accepted' => 'You must accept the terms',
    ])
  ->post() }}


    @if($application->user_id != auth()->user()->id && auth()->user()->hasPermission('Company_Performer' || 'Branch_Performer') || $application->performer_role_id == auth()->user()->role_id )
            @include('site.applications.performer')
    @elseif(auth()->user()->hasPermission('Plan_Business'||'Plan_Budget'))
        @include('site.applications.plan')
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


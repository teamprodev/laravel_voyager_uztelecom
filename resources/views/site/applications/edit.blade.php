@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
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
    @if($user->hasPermission('Branch_Performer') && $application->user_id != $user->id || $user->hasPermission('Company_Performer') && $application->user_id != $user->id || $application->performer_role_id == $user->role_id )
            @include('site.applications.performer')
    @elseif($user->hasPermission('Plan_Budget') || $user->hasPermission('Plan_Business'))
        @include('site.applications.plan')
    @elseif($user->hasPermission('Number_Change') && !$user->hasPermission('Plan_Budget') && !$user->hasPermission('Plan_Business'))
        @include('site.applications.number_edit')
    @else
        @include('site.applications.form_edit')
    @endif
    {{ Aire::close() }}
@endsection


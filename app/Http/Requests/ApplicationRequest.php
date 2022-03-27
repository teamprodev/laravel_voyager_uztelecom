<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'initiator' => 'nullable',
            'purchase_basis' => 'nullable',
            'specification' => 'nullable',
            'delivery_date' => 'nullable',
            'name' => 'nullable',
            'basis' => 'nullable',
            'separate_requirements' => 'nullable',
            'expire_warranty_date' => 'nullable',
            'planned_price' => 'nullable',
            'info_business_plan' => 'nullable',
            'equal_planned_price' => 'nullable',
            'filial_initiator_id' => 'nullable',
            'subject' => 'nullable',
            'type_of_purchase_id' => 'nullable',
            'info_purchase_plan' => 'nullable',
            'comment' => 'nullable',
            'signers' => 'nullable',
        ];
    }
}

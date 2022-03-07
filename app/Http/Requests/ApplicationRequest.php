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
            'name' => 'nullable',
            'procurement_plan' => 'nullable',
            'other_requirements' => 'nullable',
            'separate_requirements' => 'nullable',
            'purchase_basis' => 'nullable',
            'budget_planning' => 'nullable',
            'delivery_date' => 'nullable',
            'specification' => 'nullable',
            'comment' => 'nullable',
            'expire_warranty_date' => 'nullable',
            'user_id' => 'nullable',
            'status' => 'nullable',
            'plan_id' => 'nullable',
            'initiator' => 'nullable',
            'basis' => 'nullable',
            'report' => 'nullable',
            'amount' => 'nullable',
            'incoterms' => 'nullable',
        ];
    }
}

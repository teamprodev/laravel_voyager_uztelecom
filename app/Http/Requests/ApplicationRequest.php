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
            'name' => 'required',
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
            'special_specification' => 'nullable',
            'amount' => 'nullable',
            'currency' => 'nullable',
            'incoterms' => 'nullable',
            'business_planned' => 'nullable',
            'purchase_plan' => 'nullable',
            'file_basis' => 'nullable',
            'file_tech_spec' => 'nullable',
            'other_files' => 'nullable',
            'draft' => 'nullable',
        ];
    }
}

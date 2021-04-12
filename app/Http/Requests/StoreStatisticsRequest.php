<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatisticsRequest extends FormRequest
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
            'link' => 'required',
            'link_type' => 'required',
            'customer_uuid' => 'required'
        ];
    }

    public function getLink(): string
    {
        return $this->request->get('link');
    }

    public function getLinkType(): string
    {
        return $this->request->get('link_type');
    }

    public function getCustomerUuid(): string
    {
        return $this->request->get('customer_uuid');
    }
}

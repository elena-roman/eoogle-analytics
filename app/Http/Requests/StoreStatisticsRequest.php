<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @OA\Schema(
 * required={"link","link_type", "customer_uuid"},
 * @OA\Xml(name="StoreStatisticsRequest"),
 * @OA\Property(property="link", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="link_type", type="string", readOnly="true", description="User role"),
 * @OA\Property(property="customer_uuid", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
 * )
 */
class StoreStatisticsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
}

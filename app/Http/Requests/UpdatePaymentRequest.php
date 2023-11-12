<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->request->get('project'))
            return [
                'project' => 'required|integer',
                'invoice' => 'required|integer',
                'status' => 'required|max:255',
                'amount' => 'required|integer',
                'amount_paid' => 'required|integer',
                'rand' => 'required|max:255',
            ];

        return [
            'merchant_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'status' => 'required|max:255',
            'amount' => 'required|integer',
            'amount_paid' => 'required|integer',
            'timestamp' => 'required|integer',
            'sign' => 'required|max:255',
        ];
    }
}

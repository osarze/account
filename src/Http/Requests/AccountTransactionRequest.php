<?php

namespace Osarze\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountTransactionRequest extends FormRequest
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
            'account_no' => [
                'required',
                'digits:10',
                Rule::exists(config('account.table_name'), 'account_no'),
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'description' => [
                'nullable',
                'string',
                'max:190'
            ],
        ];
    }
}

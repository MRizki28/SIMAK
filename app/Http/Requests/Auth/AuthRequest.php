<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
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
    public function rules()
    {

        if ($this->is("api/v1/auth/update/*")) {
            $rules['id_position'] = 'required';
            $rules['name'] = 'required';
            $rules['username'] = [
                'required',
                Rule::unique('users', 'username')->ignore($this->route('id')),
            ];
        } else {
            $rules['id_position'] = 'required';
            $rules['name'] = 'required';
            $rules['username'] = 'required|unique:users,username';
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'message' => 'Check your validation',
            'errors' => $validator->errors()
        ]));
    }
}

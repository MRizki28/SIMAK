<?php

namespace App\Http\Requests\TypeDocument;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TypeDocumentRequest extends FormRequest
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
        $rules = [];

        if ($this->is("v1/typedocument/update/*")) {
            $rules = [
                'name_type_document' => [
                    'required',
                    Rule::unique('tb_type_document', 'name_type_document')
                    ->ignore($this->route('id'), 'id')
                ]
            ];
        } else {
            $rules = [
                'name_type_document' => 'required|unique:tb_type_document,name_type_document',
            ];
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

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
        $userId = auth()->id();

        $rules = [];

        if ($this->is("api/v1/typedocument/update/*")) {
            $rules = [
                'name_type_document' => [
                    'required',
                    Rule::unique('tb_type_document', 'name_type_document')
                        ->where(function ($query) use ($userId) {
                            $query->where('id_user', $userId);
                        })
                        ->ignore($this->route('id'))
                ]
            ];
        } else {
            $rules = [
                'name_type_document' => 'required|unique:tb_type_document,name_type_document,NULL,id,id_user,' . $userId,
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

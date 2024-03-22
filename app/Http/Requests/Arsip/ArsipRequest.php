<?php

namespace App\Http\Requests\Arsip;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArsipRequest extends FormRequest
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
        $rules = [];

        if ($this->is("api/v1/arsip/update/*")) {
            $rules = [
                'id_type_document' => 'required',
                'id_year' => 'required',
                'code_arsip' => 'required',
                'date_arsip' => 'required',
                'description' => 'required',
                'in_or_out_arsip' => 'required|in:suratMasuk,suratKeluar,jenisLain',
            ];
        } elseif ($this->is("api/v1/arsip/add/file")) {
            $rules = [
                'id_arsip' => 'required',
                'file_arsip' => 'required',
            ];
        } else {
            $rules = [
                'id_type_document' => 'required',
                'id_year' => 'required',
                'code_arsip' => 'required',
                'date_arsip' => 'required',
                'description' => 'required',
                'file_arsip' => 'required',
                'in_or_out_arsip' => 'required|in:suratMasuk,suratKeluar,jenisLain',
            ];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            "message" => 'Check your validation',
            'error' => $validator->errors()
        ]));
    }
}

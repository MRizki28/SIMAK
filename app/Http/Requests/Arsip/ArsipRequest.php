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
         // 'code_arsip' => 'required|unique:tb_arsip,code_arsip,id_user,' . auth()->id()
        if ($this->is("api/v1/update/*")) {
            $rules["id_type_document"] = "required";
            $rules["id_year"] = "required";
            $rules["code_arsip"] = "required";
            $rules["file_arsip"] = "mimes:png,jpg,pdf,docx,doc,xlxs,xlx,csv";
            $rules["date_arsip"] = "required";
            $rules["description"] = "required";
            $rules["in_or_out_arsip"] = "required|in:suratMasuk,suratKeluar, tidakKeduanya";
        } else {
            $rules["id_type_document"] = "required";
            $rules["id_year"] = "required";
            $rules["code_arsip"] = "required";
            $rules["file_arsip"] = "required|mimes:png,jpg,jpeg,pdf,docx,doc,xlxs,xlx,csv";
            $rules["date_arsip"] = "required";
            $rules["description"] = "required";
            $rules["in_or_out_arsip"] = "required|in:suratMasuk,suratKeluar, tidakKeduanya";
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

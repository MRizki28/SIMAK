<?php

namespace App\Http\Requests\Arsip;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
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

        $userId = auth()->id();
        $rules = [];

        if ($this->is("v1/arsip/update/*")) {
            $rules = [
                'id_type_document' => 'required',
                'id_year' => 'required',
                'code_arsip' =>  [
                    'required',
                    Rule::unique('tb_arsip', 'code_arsip')
                        ->where(function ($query) use ($userId) {
                            $query->where('id_user', $userId);
                        })
                        ->ignore($this->route('id')),
                    ],
                'date_arsip' => 'required',
                'description' => 'required',
                'in_or_out_arsip' => 'required|in:suratMasuk,suratKeluar,jenisLain',
            ];
        } elseif ($this->is("v1/arsip/add/file")) {
            $rules = [
                'id_arsip' => 'required',
                'file_arsip' => 'required|array',
                'file_arsip.*' => 'mimes:png,jpg,jpeg,pdf,docx,doc,xlsx,xls,csv',        
            ];
        } else {
            $rules = [
                'id_type_document' => 'required',
                'id_year' => 'required',
                'code_arsip' => 'required|unique:tb_arsip,code_arsip,NULL,id,id_user,' . $userId,
                'date_arsip' => 'required',
                'description' => 'required',
                'file_arsip' => 'required|array',
                'file_arsip.*' => 'mimes:png,jpg,jpeg,pdf,docx,doc,xlsx,xls,csv',
                'in_or_out_arsip' => 'required|in:suratMasuk,suratKeluar,jenisLain',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'file_arsip.*.mimes' => 'Format file tidak sesuai',
        ];
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

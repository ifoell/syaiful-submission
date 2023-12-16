<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreEmployeesRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'job_title' => 'required|string|max:50',
            'salary' => 'required|numeric',
            'department' => 'required|string|max:50',
            'joined_date' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(response()->json([
        'success'   => false,
        'message'   => 'Validation errors',
        'data'      => $validator->errors()
    ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'job_title.required' => 'Job title is required!',
            'salary.required' => 'Salary is required!',
            'salary.numeric' => 'Salary must be numeric!',
            'department.required' => 'Department is required!',
            'joined_date.required' => 'Joined date is required!'
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateusers extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->segment(3);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,{$id},id'],
            'password' => ['required', 'string', 'min:4'],
        ];

        if ($this->method() == 'PUT') {

            $rules = [
                'password' => 'nullable', 'string', 'min:4',
                'email' => 'nullable'
            ];
        }
        return $rules;
    }
}

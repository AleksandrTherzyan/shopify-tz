<?php


namespace App\Requests;


use Illuminate\Foundation\Http\FormRequest;

class WorkshopRegisterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'email' => 'required|email',
            'customer.name' => 'required|string|max:50',
            'customer.phone' => 'required',
        ];
    }

}
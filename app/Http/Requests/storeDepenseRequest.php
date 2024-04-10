<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeDepenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     public function authorize()
     {
         return true;
     }

     public function rules()
     {
         return [
             'amount' => 'required|numeric',
             'Description' => 'required|string',
             'date' => 'required|date',
             'user_id' => 'required|exists:users,id',
         ];
     }
}

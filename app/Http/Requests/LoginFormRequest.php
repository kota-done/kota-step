<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Test_user;
class LoginFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            // 'name'=>'required',
          'email'=>'required|max:255',
          'password'=>'required',
        ];
    }
}

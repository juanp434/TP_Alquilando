<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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

    //get the route parameter and pass to request data
    public function all($keys = null) 
    {
        $data = parent::all($keys);
        $data['user_id'] = $this->route('user_id');
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|between:2,100',
            'surname' => 'required|between:2,100',
            'user' => 'required|unique:users|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
}

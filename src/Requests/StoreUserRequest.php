<?php

namespace ConfrariaWeb\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->hasPermission('admin.users.create') || Auth::user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'unique:App\User,email',
            'password' => 'required|confirmed|min:6',
            'sync.roles' => 'required',
        ];
    }

    public function messages()
    {
        return config('cw_user.request.messages') ?? [];
    }
}

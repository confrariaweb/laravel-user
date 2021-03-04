<?php

namespace ConfrariaWeb\User\Requests;

use App\Models\User;
use ConfrariaWeb\User\Rules\UserPasswordUpdate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $account = account();
        $user = User::find($this->route()->parameter('user'));
        $accountUser = existsAccount() ? ($account->id === $user->account_id) : true;
        return (Auth::user()->hasPermission('admin.users.edit') && $accountUser) || Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->route()->parameter('user')),
            ],
            'password' => [
                new UserPasswordUpdate()
            ],
            'sync.roles' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return config('cw_user.request.messages') ?? [];
    }
}

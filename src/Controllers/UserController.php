<?php

namespace ConfrariaWeb\User\Controllers;

use ConfrariaWeb\User\Requests\StoreUserRequest;
use ConfrariaWeb\User\Requests\UpdateUserRequest;
use ConfrariaWeb\User\Resources\Select2UserResource;
use ConfrariaWeb\User\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use Collective\Html\Eloquent\FormAccessible;

class UserController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['statuses'] = resolve('UserStatusService')->pluck();
        $this->data['roles'] = resolve('RoleService')->pluck();
    }

    public function apiTokenGenerate($id)
    {
        $user = resolve('UserService')->apiTokenGenerate($id);
        return back()->withInput()->with('status', 'Token alterado com sucesso');
    }

    public function datatables(){
        $users = resolve('UserService')->all();
        return Datatables::of($users)
        ->addColumn('roles', function (User $user) {
            return $user->roles->map(function($role) {
                return $role->display_name;
            })->implode('<br>');
        })
        ->addColumn('action', function ($user) {
            return '<div class="btn-group btn-group-sm float-right" role="group">
                <a href="'.route('admin.users.show', $user->id).'" class="btn btn-sm btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="'.route('admin.users.edit', $user->id).'" class="btn btn-sm btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-sm btn-danger" href="'.route('admin.users.destroy', $user->id).'" onclick="event.preventDefault();
                    document.getElementById(\'users-destroy-form\').submit();">
                    Deletar
                </a>
                <form id="users-destroy-form" action="'.route('admin.users.destroy', $user->id).'" method="POST" style="display: none;">
                    @csrf
                    @method(\'DELETE\')
                    <input type="hidden" name="id" value="'.$user->id.'">
                </form>
            </div>';
        })
        ->make();
    }

    public function select2(Request $request)
    {
        $data = $request->all();
        $data['name'] = isset($data['term']) ? $data['term'] : NULL;
        $users = resolve('UserService')->where($data)->get();
        return Select2UserResource::collection($users);
    }

    public function index(Request $request)
    {
        $this->data['get'] = array_filter($request->all(), function ($e) {
            if (is_array($e)) {
                return array_filter($e);
            }
            return $e;
        });
        $this->data['roles'] = resolve('RoleService')->all();
        return view(config('cw_user.views') . 'users.index', $this->data);
    }

    public function create()
    {
        return view(config('cw_user.views') . 'users.create', $this->data);
    }

    public function store(StoreUserRequest $request)
    {
        $user = resolve('UserService')->create($request->all());
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('status', 'Cadastro criado com sucesso!');
    }

    public function show($id, $page = 'overview')
    {
        $this->data['user'] = resolve('UserService')->find($id);
        return view(config('cw_user.views') . 'users.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['user'] = resolve('UserService')->find($id);
        return view(config('cw_user.views') . 'users.edit', $this->data);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = resolve('UserService')->update($request->all(), $id);
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('status', 'Usuário editado com sucesso!');
    }

    public function destroy($id)
    {
        $user = resolve('UserService')->destroy($id);
        if (!$user) {
            return back()->withInput()->with('danger', 'Usuário não encontrado');
        }
        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Usuário deletado com sucesso');
    }

}

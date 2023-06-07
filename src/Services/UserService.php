<?php

namespace ConfrariaWeb\User\Services;

use ConfrariaWeb\User\Exceptions\UserNotFoundException;
use ConfrariaWeb\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{

    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function find($id)
    {
        try {
            $user = $this->repository->find($id);
        } catch (\Throwable $th) {
            throw new UserNotFoundException("Usuário não encontrado com o ID: $id");
        }
        return $user;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function paginate($perPage = 15)
    {
        return $this->repository->paginate($perPage);
    }

    public function create($data)
    {
        try {

            if (!isset($data['password']) || empty($data['password'])) {
                throw new \InvalidArgumentException('O campo de senha é obrigatório.');
            }
    
            $this->validatePassword($data['password']);

            if (empty($data['password'])) {
                $data['password'] = Hash::make(Str::random(8));
            }

            $user = $this->repository->create($data);
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }
        } catch (\Throwable $th) {
            throw new \Exception('Erro ao criar o usuário: ' . $th->getMessage(), $th->getCode());
        }

        return $user;
    }

    public function update($id, $data)
    {
        try {
            if (isset($data['password']) && !empty($data['password'])) {
                $this->validatePassword($data['password']);
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user = $this->repository->update($id, $data);
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }
        } catch (\Throwable $th) {
            throw new \Exception('Erro ao atualizar o usuário: ' . $th->getMessage());
        }
        return $user;
    }

    public function destroy($id)
    {
        try {
            $user = $this->repository->destroy($id);
        } catch (\Throwable $th) {
            throw new \Exception('Erro ao excluir o usuário: ' . $th->getMessage());
        }
        return $user;
    }

    private function validatePassword($password)
    {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('A senha deve ter pelo menos 8 caracteres.', 422);
        }

        if (preg_match('/\d{8,}/', $password)) {
            throw new \InvalidArgumentException('A senha não pode ser uma sequência de números.', 422);
        }

        if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
            throw new \InvalidArgumentException('A senha deve conter pelo menos uma letra e um número.', 422);
        }
    }

}

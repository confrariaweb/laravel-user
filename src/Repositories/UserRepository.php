<?php

namespace ConfrariaWeb\User\Repositories;

use App\Models\User;
use ConfrariaWeb\User\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function find(int $id): User
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            \Log::error('User not found: ' . $exception->getMessage());
            throw new UserNotFoundException('User not found', $exception->getCode(), $exception);
        } catch (QueryException $exception) {
            \Log::error('Error finding user: ' . $exception->getMessage());
            throw new RepositoryException('Error finding user', $exception->getCode(), $exception);
        } catch (Throwable $exception) {
            \Log::error('Unexpected error finding user: ' . $exception->getMessage());
            throw new RepositoryException('Unexpected error finding user', $exception->getCode(), $exception);
        }
    }

    public function paginate($perPage = 15)
    {
        try {
            return $this->model->paginate($perPage);
        } catch (QueryException $exception) {
            \Log::error('Error paginating users: ' . $exception->getMessage());
            throw new RepositoryException('Error paginating users', $exception->getCode(), $exception);
        } catch (Throwable $exception) {
            \Log::error('Unexpected error paginating users: ' . $exception->getMessage());
            throw new RepositoryException('Unexpected error paginating users', $exception->getCode(), $exception);
        }
    }

    public function all($columns = array('*'))
    {
        try {
            return $this->model->get($columns);
        } catch (QueryException $exception) {
            \Log::error('Error retrieving all users: ' . $exception->getMessage());
            throw new RepositoryException('Error retrieving all users', $exception->getCode(), $exception);
        } catch (Throwable $exception) {
            \Log::error('Unexpected error retrieving all users: ' . $exception->getMessage());
            throw new RepositoryException('Unexpected error retrieving all users', $exception->getCode(), $exception);
        }
    }

    public function create(array $data): User
    {
        try {
            DB::beginTransaction();
            $user = User::create($data);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(int $id, array $data): User
    {
        try {
            DB::beginTransaction();
            $user = $this->find($id);
            $user->update($data);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(int $id): bool
    {
        try {
            DB::beginTransaction();
            $user = $this->find($id);
            $user->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

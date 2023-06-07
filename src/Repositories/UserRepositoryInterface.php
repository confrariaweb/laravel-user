<?php

namespace ConfrariaWeb\User\Repositories;

interface UserRepositoryInterface
{
    public function find(int $id);

    public function all();

    public function paginate($perPage = 15);

    public function create(array $data);

    public function update(int $id, array $data);

    public function destroy(int $id);
}

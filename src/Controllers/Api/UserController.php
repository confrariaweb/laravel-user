<?php

namespace ConfrariaWeb\User\Controllers\Api;

use App\Http\Controllers\Controller;
use ConfrariaWeb\User\Exceptions\UserNotFoundException;
use ConfrariaWeb\User\Requests\UserStoreRequest;
use ConfrariaWeb\User\Requests\UserUpdateRequest;
use ConfrariaWeb\User\Resources\UserResource;
use ConfrariaWeb\User\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userService->paginate($request->input('per_page', 15));
            return UserResource::collection($users);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $user = $this->userService->find($id);
            if (!$user) {
                throw new UserNotFoundException();
            }
            return new UserResource($user);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->userService->create($request->validated());
            return new UserResource($user);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = $this->userService->update($id, $request->validated());
            return new UserResource($user);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->destroy($id);
            return response()->json([], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

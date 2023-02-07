<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::query()->paginate(6, ['*'], 'page', request('page')));
    }

    public function store(UserRequest $request): object
    {
        $user = User::create($request->validated());
        return new UserResource($user);
    }

    public function show(User $user): object
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user): object
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function destroy(User $user): Response
    {
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

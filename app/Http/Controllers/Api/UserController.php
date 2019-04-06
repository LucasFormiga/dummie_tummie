<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $users = User::orderBy('first_name', 'asc')
                    ->orderBy('last_name', 'asc')
                    ->paginate(10);

        return new UserCollection($users);
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'sex' => $request->sex,
                'cpf' => $request->cpf,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->email = $request->email;

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

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
use JWTAuth;

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

    /**
     * API Login, on success return JWT Auth token
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'message' => $validator->messages()
            ]);
        }
        try {
            // Attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'We can`t find an account with this credentials.'
                ], 401);
            }
        } catch (JWTException $e) {
            // Something went wrong with JWT Auth.
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to login, please try again.'
            ], 500);
        }
        // All good so return the token
        return response()->json([
            'status' => 'success', 
            'data'=> [
                'token' => $token
                // You can add more details here as per you requirment. 
            ]
        ]);
    }

    /**
     * Logout
     * Invalidate the token. User have to relogin to get a new token.
     * @param Request $request 'header'
     */
    public function logout(Request $request) 
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('Authorization');
        // Invalidate the token
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'status' => 'success', 
                'message'=> "Usuário saiu com sucesso."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
              'status' => 'error', 
              'message' => 'Falha ao tentar sair, tente novamente.'
            ], 500);
        }
    }
}

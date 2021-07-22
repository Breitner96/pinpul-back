<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Entities\Provider;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Support\Str;

use App\Traits\Utilities;

class AuthController extends Controller
{

    use Utilities;

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // return response()->json(auth()->user());
        // return $token;
        // return response()->json(compact('token'));

        return response()->json([
            'access_token' => $token,
            // 'token_type' => 'bearer',
            'user' => $this->me()->original,
            'rol' => $this->me()->original->rol,
            // 'permissions' => $this->me()->original->permissions
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('user'));
    }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','registerProvider']]);
    // }

    // public function registerProvider(Request $request){

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     if( $request->type_user == true ){
    //         $user->assignRole( 'proveedor' );
    //     } else {
    //         $user->assignRole( 'cliente' );
    //     }
    //     return response()->json([
    //         'messages' => 'Registro exitoso'
    //     ]);
    // }

    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Credenciales Incorrectas']);
    //     }

    //     return $this->respondWithToken($token);
    // }

    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }

    // public function logout()
    // {
    //     auth()->logout();
    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    // protected function respondWithToken($token)
    // {
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 180,
        //     'user' => $this->me()->original,
        //     'rol' => $this->me()->original->rol,
        //     // 'permissions' => $this->me()->original->permissions
        // ]);
    // }

}
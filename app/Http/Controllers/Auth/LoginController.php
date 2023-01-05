<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{ 
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    } 

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginww(Request $request)
    {

       // dd($request); exit;
        $credentials = request(['email', 'password']);
        $this->validateLogin($request);

       // dd($credentials);
        if (! $token = auth()->attempt($credentials)) {
            $error['email'][0] = 'These credentials do not match our records';
           // return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json([
                    'errors'=>$error,
                    'status'=>'error'

                ],JsonResponse::HTTP_UNAUTHORIZED);

        }
        return $this->respondWithToken($token, $request->email);
    }



    protected function login(Request $request){
        $credentials = $request->only('email', 'password');
        $this->validateLogin($request);
        if (JWTAuth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0]) == false) {
            $error['email'][0] = 'These credentials do not match our records';
            return response()->json([
                    'errors'=>$error,
                    'status'=>'error'
                ],JsonResponse::HTTP_UNAUTHORIZED);
        }
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error'=>'invalid credentials'
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json([
                'status' => 'error',
                'error'  => 'could not create token'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        $user = Auth::user();
        return response()->json([
            'status'     =>  'success',
            'user'       =>   $user,
            'token'      =>   $token,
            'token_type' =>  'bearer',
            'expires_in' =>  env('JWT_TTL', 60),
        ]);
    }

      protected function loginBk(Request $request)
    {
        $credentials = $request->only('email', 'password');
         $this->validateLogin($request);
        if (JWTAuth::attempt($credentials) == false) {
            //return $this->sendFailedLoginResponse($request);

             $error['email'][0] = 'These credentials do not match our records';
           // return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json([
                    'errors'=>$error,
                    'status'=>'error'

                ],JsonResponse::HTTP_UNAUTHORIZED);
        }
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error'=>'invalid credentials'
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json([
                'status' => 'error',
                'error'  => 'could not create token'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        $user = Auth::user();
        return response()->json([
            'status'     =>  'success',
            'user'       =>   $user,
            'token'      =>   $token,
            'token_type' =>  'bearer',
            'expires_in' =>  env('JWT_TTL', 60),
        ]);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|string',
            'password'  => 'required|string',
        ]);
    }

       protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $email)
    {
        
        $user = User::select('*', 'users.id AS id', 'roles.id AS roleid')
                ->join('roles', 'users.role_type', '=', 'roles.id')
                ->where('users.email', '=', $email)->first();     
        if(!empty($user)) {
            return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->factory()->getTTL() * 120,
            'roles'         => $user->title,
            'username'      => $user->user_name,
            'email'         => $user->email,
            'userid'        => $user['id'],
            'roleid'        => $user['roleid'],
            'status'        =>'success'
        ]); 
        }else{
            return response()->json([
                    'error'=>'invalid credentials',
                    'status'=>'error'
                ],JsonResponse::HTTP_UNAUTHORIZED);
        }
 
    }
}
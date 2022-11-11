<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role_id = $request->role;

        // Check if field is empty
        if (empty($name) or empty($email) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'error', 'message' => 'You must enter a valid email']);
        }

        // Check if password is greater than 5 character
        if (strlen($password) < 6) {
            return response()->json(['status' => 'error', 'message' => 'Password should be min 6 character']);
        }

        // Check if user already exist
        if (User::where('email', '=', $email)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'User already exists with this email']);
        }

        // Create new user
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = app('hash')->make($request->password);
            // $user->role_id = '2' ;
            $user->role_id = $request->role ;

            if ($user->save()) {
                return $this->login($request);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'name'=>'required|string|min:2|max:100',
    //         'email'=>'required|string|email|max:100|unique:users',
    //         'password'=>'required|string|min:6'
    //     ]);

    //     if ($validator->fails())
    //     {
    //         return response()->json($validator->errors(),400);
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email'=> $request->email,
    //         'password' => Hash::make($request->password)
    //     ]);

    //     return response()->json([
    //         'message' => 'User registered Successfully',
    //         'user' => $user
    //     ]);
    // }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Check if field is empty
        if (empty($email) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userdetail= User::where('email', $request->email)->first();
        // dd($userdetail);
        // dd('ddssss');
        return $this->respondWithToken($token);
        //return route('');
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
     {
         return response()->json([
             'access_token' => $token,
             'token_type' => 'bearer',
             'expires_in' => auth()->factory()->getTTL() * 60
         ]);
     }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function logindata(){
        //dd('hh');
        return User::all();
    }

}

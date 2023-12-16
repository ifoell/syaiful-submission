<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function authorization(Request $request): ApiResponse
    {
        $encryptedKey = $request->get('key');

        if ($encryptedKey) {
            Log::info('encryption method');
            // Decrypt the key to get the access token
            $decryptedKey = Crypt::decrypt($encryptedKey);
            [$accessTokenId, $url, $language, $salt] = explode('|', $decryptedKey);

            // Retrieve the user associated with the access token
            $user = ModelsMember::where('id', $accessToken->user_id)->first();

            // Retrieve the access token
            $accessToken = $user->getAccessToken();

            // Check if the access token is valid
            if ($accessToken && !$accessToken->revoked) {
                // Authenticate the user
                auth()->login($user);
                Log::info('access token valid');
                // Return the authenticated user
                // return $user;
            } else {
                throw new UnAuthorizedException(['message' => trans('define.auth.client.login.unauthorized')]);
            }
        }
    }

}

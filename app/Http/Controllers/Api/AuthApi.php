<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthApi extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    /**
     * @var Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    public function __construct(JWTAuth $jwt, Auth $auth)
    {
        $this->jwt = $jwt;
        $this->auth = $auth;
    }
    public function testlogin(Request $request){
      return response()->json(["aaa"], 200);
    }
    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        $token = $this->jwt->attempt($credentials);

        try {
            if (! $token = $this->jwt->attempt($credentials)) {
                return response()->json(['not_found'], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);
        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);
        } catch (JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        $user = $this->auth->user();
        $user->token = $token;
        $user->login_date = date("Y-m-d h:i:s");
        $user->save();

        return response()->json(compact('token','user'));
    }

    public function logout(Request $request)
    {

    }
}

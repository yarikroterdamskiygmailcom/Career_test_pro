<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Model\oauthAccessToken;
use Illuminate\Support\Facades\Auth;
use Validator;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'key' => 'required|string',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        if($request->key != '123456789') return $this->sendError('Admin key error', 'Wrong admin key', 202);

        $input = $request->all();
        $input['password'] = md5($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;


        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = md5($input['password']);
        $user = User::where('email', $request->email)
            ->where('password', $input['password'])
            ->first();
        if(!$user) {
            return $this->sendError('Authorization failed.', '', 401);
        }
        $success['token'] =  $user->createToken('New token')->accessToken;

        return $this->sendResponse($success, 'User authorized successfully.');


    }

    public function logout() {
        oauthAccessToken::where('user_id', Auth::user()->id)->delete();
        return $this->sendResponse('', 'User logged out successfully.');
    }

}
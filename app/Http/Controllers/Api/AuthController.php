<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\RegisterRequest;
use Auth;
use Symfony\Component\HttpFoundation\Response as Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    Use ApiResponse;
    public function register(RegisterRequest $request)
    {
    	$validated = $request->validated();
    	$user = User::create([
    		'name'=>$validated['name'],
    		'email'=>$validated['email'],
    		'password'=>bcrypt($validated['password']),
    	]);

    	$token = $user->createToken('auth_token')->plainTextToken;
    	return $this->apiSuccess([
    		'token'=>$token,
    		'token_type'=>'Bearer',
    		'user'=>$user,
    	]);
    }
}

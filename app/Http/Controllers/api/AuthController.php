<?php

namespace App\Http\Controllers\api;
use App\User;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    use ProcessResponseTrait,HasApiTokens;

    public function register(Request $request)
   {
    //
   }

    public function login(Request $request)
    {
        $logindata=$request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
      
       try {
        $http = new \GuzzleHttp\Client;
        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => '6gDFpGiO81u9483xPw9BiApu6AHFGniQzQasRzYb',
                'username' => 'admin@123.com',
                'password' => 'password',
                'scope' => '*',
            ],
            ]);

        return json_decode((string) $response->getBody(), true);
            }
        catch (\GuzzleHttp\Exception\BadResponseException $e){
            return $this->processResponse($e->getCode(),'error','Something went wrong');
        }
    }

    public function logout()
    {
        
        $tokens=Auth::user()->tokens;
        dump($tokens);
        foreach($tokens as $token)
        {
            $token->revoke();
        }

        return $this->processResponse(null,'success','Logged out successfully!');
    }
       
}

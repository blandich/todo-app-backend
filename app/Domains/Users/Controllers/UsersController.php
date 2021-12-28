<?php

namespace LawAdvisor\Domains\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LawAdvisor\Models\User;
use Validator;
use LawAdvisor\Base\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }

    public function login(Request $request)
    {
        $authResponse = null;

        try {
            $client = new Client();

            $authResponse = $client->post('http://localhost:8000/api/v1/oauth/token', [
                'form_params' => [
                    'client_secret' => 'qehzxnaiqweSJSNSKSJSDH',
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'username' => $request->input('email'),
                    'password' => $request->input('password'),
                ],
            ]);
            $authResponse = $this->authService->login($request->input('email'), $request->input('password'));
        } catch (GuzzleException $e) {
            $status = $e->getResponse()->getStatusCode();
            $content = json_decode($e->getResponse()->getBody()->getContents());

            $authResponse = new JsonResponse($content->message, $status);
        }

        return $authResponse;
    }

}

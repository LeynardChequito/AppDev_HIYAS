<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

use Firebase\JWT\JWT;
use Firebase\JWT\KEY;

class LoginController extends ResourceController
{
    use ResponseTrait;

    public function login()
    {
        // Use $this->request->getJSON() to get JSON input
        $json = $this->request->getJSON();

        // Extract email and password from the JSON data
        $email = $json->mobile_or_email;
        $password = $json->password;

        $userModel = new AccountModel();

        $user = $userModel->where('mobile_or_email', $email)->first();

        if (is_null($user)) {
            return $this->respond(['error' => 'Email does not exist'], 401);
        }

        $pwd_verify = password_verify($password, $user['password']);

        if (!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = [
            "iss" => "localhost",
            "aud" => "localhost",
            // "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['mobile_or_email'],
            "firstname" => $user['firstname'],
            "id" => $user['id'], // Add this line
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user,
        ];

        return $this->respond($response, 200);
    }
    public function getUser()
    {
        // $userModel = new AccountModel();

        $request = service('request');
        $key = getenv('JWT_SECRET');
        $headers = $request->getHeader('authorization');
        $token = $headers->getValue();
        // return $token;
        try {
            $decodedToken = JWT::decode($token, new KEY($key, 'HS256'));
            $email = $decodedToken->email;
            $firstname = $decodedToken->firstname;
            $id = $decodedToken->id;
            return $this->respond([
                'status' => 1,
                'user' => [
                    "id" => $id,
                    'email' => $email,
                    'firstname' => $firstname,
                    // Add other properties as needed
                ],
            ]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token');
        }
    }
}

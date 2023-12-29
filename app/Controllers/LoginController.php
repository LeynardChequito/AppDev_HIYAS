<?php

namespace App\Controllers;

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
        $json = $this->request->getJSON();

        // Authenticate the user (you should replace this with your authentication logic)
        $email = $json->mobile_or_email;
        $password = $json->password;

        // Your authentication logic goes here...
        // For example, you might use a model to check the user credentials

        // Replace the following logic with your actual authentication process
        $accountModel = new AccountModel();
        $user = $accountModel->where('mobile_or_email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful

            $payload = [
                'firstname' => $user['firstname'],
                'id' => $user['id'],
                'user_role' => $user['user_role'],
                'iat' => time(),
            ];

            $token = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

            // Store the token in the session
            session()->set('token', $token);

            $response = [
                'message' => 'Login Successful',
                'token' => $token,
                'user' => $user,
            ];

            // Return token
            return $this->respond($response, 200);
        } else {
            // Authentication failed
            return $this->failUnauthorized('Invalid credentials');
        }
    }

    public function logout()
    {
        // Remove the token from the session
        session()->remove('token');


        return $this->respond(['message' => 'Logout Successful'], 200);
    }

        // public function getUser()
        // {
        //     // $userModel = new AccountModel();

        //     $request = service('request');
        //     $key = getenv('JWT_SECRET');
        //     $headers = $request->getHeader('authorization');
        //     $token = $headers->getValue();
        //     // return $token;
        //     try {
        //         $decodedToken = JWT::decode($token, new KEY($key, 'HS256'));
        //         $email = $decodedToken->email;
        //         $firstname = $decodedToken->firstname;
        //         $id = $decodedToken->id;
        //         return $this->respond([
        //             'status' => 1,
        //             'user' => [
        //                 "id" => $id,
        //                 'email' => $email,
        //                 'firstname' => $firstname,
        //                 // Add other properties as needed
        //             ],
        //         ]);
        //     } catch (\Exception $e) {
        //         return $this->failUnauthorized('Invalid token');
        //     }
        // }
}

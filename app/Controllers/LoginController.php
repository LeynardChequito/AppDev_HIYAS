<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use \CodeIgniter\Config\Services;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;

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


    public function logout()
    {
        // Retrieve the token from the request headers
        $request = service('request');
        $headers = $request->getHeader('authorization');
        $token = $headers->getValue();

        // Check if the token exists
        if ($token) {
            try {
                // Attempt to decode the token to check if it's valid
                $this->validateToken($token);

                // Invalidate the token on the server side
                $this->addToTokenBlacklist($token);

                // Clear the token on the client side
                $this->clearTokenCookie();

                // Respond with a success message
                return $this->respond(['message' => 'Logout Successful'], 200);
            } catch (ExpiredException $e) {
                // Automatically log out when the token has expired
                return $this->respond(['message' => 'Token has expired. Logout Successful'], 200);
            } catch (BeforeValidException $e) {
                // Automatically log out when the token is not yet valid
                return $this->respond(['message' => 'Token is not yet valid. Logout Successful'], 200);
            } catch (SignatureInvalidException $e) {
                // Automatically log out when the token signature is invalid
                return $this->respond(['message' => 'Invalid token signature. Logout Successful'], 200);
            } catch (\Exception $e) {
                return $this->failUnauthorized('Logout Failed: Invalid token');
            }
        } else {
            // If no token is present, respond with a success message
            return $this->respond(['message' => 'Logout Successful (No Token Present)'], 200);
        }
    }



    private function validateToken($token)
    {
        // Attempt to decode the token
        $key = getenv('JWT_SECRET');
        JWT::decode($token, new KEY($key, 'HS256'));
    }

    private function addToTokenBlacklist($token)
    {
        // Store the invalidated token in a persistent storage, like a database
        // This example uses a simple array; in a production environment, consider using a more robust solution
        $blacklist = cache('token_blacklist') ?? [];
        $blacklist[] = $token;

        // Save the updated blacklist
        cache()->save('token_blacklist', $blacklist, 60 * 60 * 24); // Adjust the expiration time as needed
    }

    private function clearTokenCookie()
    {
        // For example, if using JWT with HttpOnly cookies, clear the cookie
        setcookie('token', '', time() - 3600, '/'); // Expire the cookie

        // Note: The exact parameters of setcookie depend on your application's setup
    }
}

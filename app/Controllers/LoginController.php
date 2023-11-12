<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class LoginController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        // Display the login view or return a response for the API
    }

    public function login()
    {
        // Handle login logic for the API
        $json = $this->request->getJSON();


        // Validate the input data
        $validationRules = [
            'mobile_or_email' => 'required|valid_email', // Adjust this validation based on your needs
            'password' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // If validation passes, attempt to log in
        $accountModel = new AccountModel();

        $user = $accountModel
            ->where('mobile_or_email', $json->mobile_or_email)
            ->first();

        if (!$user || !password_verify($json->password, $user['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        // Successfully logged in, you can set user session or perform other actions

        // Return a JSON response
        return $this->respond(['message' => 'Login successful']);
    }
}

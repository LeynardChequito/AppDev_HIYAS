<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use App\Models\StudentModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;


class SignupController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        return view('signup'); // Assuming you have a view file for the signup page
    }



    public function register()
    {
        $json = $this->request->getJSON();

        // Validate the input data
        $validationRules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_or_email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'user_role' => 'required',
        ];

        // Perform validation
        if (!$this->validate($validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        try {
            // If validation passes, create a new user
            $userData = [
                'firstname' => $json->firstname,
                'lastname' => $json->lastname,
                'mobile_or_email' => $json->mobile_or_email,
                'password' => password_hash($json->password, PASSWORD_DEFAULT),
                'user_role' => $json->user_role,
            ];

            // Insert user data
            $accountModel = new AccountModel();
            $accountId = $accountModel->insert($userData);

            // Retrieve the student record based on conditions
            $studentModel = new StudentModel(); // Replace with your actual StudentModel
            $studentRecord = $studentModel
                ->where('firstname', $json->firstname)
                ->where('lastname', $json->lastname)
                ->first();

            // Update the student record with the account ID
            if ($studentRecord) {
                $studentModel->update($studentRecord['id'], ['account' => $accountId]);
            }

            return $this->respond(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            log_message('error', 'Error in SignupController: ' . $e->getMessage());

            // Return a generic server error response
            return $this->failServerError('An error occurred while processing your request.');
        }
    }
}

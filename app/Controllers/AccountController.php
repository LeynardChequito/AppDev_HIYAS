<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AccountController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        //
    }

    public function getData()
    {
        $account = new AccountModel();
        $data = $account->findAll();
        return $this->respond($data);
    }

    public function addData()
    {
        $json = $this->request->getJSON();


        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'mobile_or_email' => $json->mobile_or_email,
            'password' => $json->password,
            'user_role' => $json->user_role,
        ];


        $accountModel = new AccountModel();
        $r = $accountModel->save($data);
        return $this->respond($r, 200);
    }


    public function updateData($id = null)
    {
        $json = $this->request->getJSON();

        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'mobile_or_email' => $json->mobile_or_email,
            'password' => $json->password,
            'user_role' => $json->user_role,
        ];

        $accountModel = new AccountModel();
        $r = $accountModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $accountModel = new AccountModel();
        $r = $accountModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }

    // AccountController.php

// Add this method to your AccountController class
public function getUserById($id = null)
{
    try {
        // Validate $id as needed

        $accountModel = new AccountModel();
        $user = $accountModel->find($id);

        if ($user) {
            return $this->respond($user);
        } else {
            return $this->failNotFound('User not found');
        }
    } catch (\Exception $e) {
        return $this->failServerError('Error fetching user details');
    }
}

}

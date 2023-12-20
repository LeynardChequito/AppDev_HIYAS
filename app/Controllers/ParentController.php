<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParentsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ParentController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        //
    }

    public function getData()
    {
        $parent = new ParentsModel();
        $data = $parent->findAll();
        return $this->respond($data);
    }

    public function addData()
    {
        $json = $this->request->getJSON();


        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'age' => $json->age,
            // Assuming 'age' is available in your JSON data
            'birthday' => $json->birthday,
            'address' => $json->address,
        ];


        $parentModel = new ParentsModel(); // Assuming you have an AccountModel
        $r = $parentModel->save($data);
        return $this->respond($r, 200);
    }


    public function updateData($id = null)
    {
        $json = $this->request->getJSON();

        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'age' => $json->age,
            'birthday' => $json->birthday,
            'address' => $json->address,
        ];

        $parentModel = new ParentsModel();
        $r = $parentModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $parentModel = new ParentsModel();
        $r = $parentModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }

    public function getTotalParents()
    {
        $parents = new ParentsModel();
        $totalParents = $parents->countAll(); // Assuming your studentModel has the countAll method

        return $this->respond(['totalParents' => $totalParents]);
    }
}

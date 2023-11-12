<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MainModel;
use App\Models\TryModel;

class MainController extends ResourceController
{
    public function index()
    {
        // Your index method logic
    }

    public function save()
    {
        $json = $this->request->getJSON();
        $data = [
            'lastname' => $json->lastname,
            'firstname' => $json->firstname,
            'gender' => $json->gender,
            'age' => $json->age,
        ];
        $main = new TryModel();
        $r = $main->save($data);
        return $this->respond($r, 200); 
    }

    public function del()
    {
        $json = $this->request->getJSON();
        $id = $json->id;
        $main = new TryModel();
        $r = $main->delete($id);
        return $this->respond($r, 200); 
    }

    public function getData()
    {
        $main = new TryModel();
        $data = $main->findAll();
        return $this->respond($data);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoachModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class CoachController extends ResourceController
{
    public function index()
    {
        //
    }

    public function getData()
    {
        $student = new CoachModel();
        $data = $student->findAll();
        return $this->respond($data);
    }

    public function addData()
    {
        $json = $this->request->getJSON();


        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'age' => $json->age,  // Assuming 'age' is available in your JSON data
            'birthday' => $json->birthday,
            'phone' => $json->phone,  // Assuming 'phone' is available in your JSON data
            'gender' => $json->gender,
            'date_hired' => $json->date_hired,
            'coach_id' => $json->coach_id,
            'address' => $json->address,
        ];


        $coachModel = new CoachModel(); // Assuming you have an AccountModel
        $r = $coachModel->save($data);
        return $this->respond($r, 200);
    }
}

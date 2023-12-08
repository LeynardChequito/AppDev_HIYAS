<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoachModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class CoachController extends ResourceController
{
    use ResponseTrait;
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
            'gender' => $json->gender->value,
            'date_hired' => $json->date_hired,
            'coach_id' => $json->coach_id,
            'address' => $json->address,
        ];


        $coachModel = new CoachModel(); // Assuming you have an AccountModel
        $r = $coachModel->save($data);
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
            'phone' => $json->phone,
            'gender' => $json->gender->value,
            'date_hired' => $json->date_hired,
            'coach_id' => $json->coach_id,
            'address' => $json->address,
        ];

        $coachModel = new CoachModel();
        $r = $coachModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $coachModel = new CoachModel();
        $r = $coachModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }
}

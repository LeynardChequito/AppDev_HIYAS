<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class StudentController extends ResourceController
{
    public function index()
    {
        //
    }

    public function getData()
    {
        $student = new StudentModel();
        $data = $student->findAll();
        return $this->respond($data);
    }

    public function getDataById($id)
    {
        $student = new StudentModel();
        $data = $student->find($id);

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Student not found');
        }
    }
}

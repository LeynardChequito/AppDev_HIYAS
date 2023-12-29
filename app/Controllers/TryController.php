<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class TryController extends ResourceController
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
}

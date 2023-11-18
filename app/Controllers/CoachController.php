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
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TryModel;
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
        $try = new TryModel();
        $data = $try->findAll();
        return $this->respond($data);
    }
}

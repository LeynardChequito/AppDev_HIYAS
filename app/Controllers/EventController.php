<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class EventController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        //
    }

    public function getData()
    {
        $events = new EventModel();
        $data = $events->findAll();
        return $this->respond($data);
    }

    public function addData()
    {
        $json = $this->request->getJSON();


        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'start' => $json->start,
            'end' => $json->end,  // Assuming 'age' is available in your JSON data
            'audience' => $json->audience,
        ];


        $eventModel = new EventModel(); // Assuming you have an AccountModel
        $r = $eventModel->save($data);
        return $this->respond($r, 200);
    }


    public function updateData($id = null)
    {
        $json = $this->request->getJSON();

        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'start' => $json->start,
            'end' => $json->end,  // Assuming 'age' is available in your JSON data
            'audience' => $json->audience,
        ];

        $eventModel = new EventModel();
        $r = $eventModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $eventModel = new EventModel();
        $r = $eventModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }
}

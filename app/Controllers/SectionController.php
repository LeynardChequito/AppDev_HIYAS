<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SectionModel;
use App\Models\CoachModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class SectionController extends ResourceController
{
    public function index()
    {
        //
    }

    public function getData()
    {
        $sections = new SectionModel();
        $data = $sections->findAll();

        // Fetch coach details for each section and replace coach ID with coach name
        $coachModel = new CoachModel();
        foreach ($data as &$section) {
            $coachDetails = $coachModel->find($section['coach']);

            if ($coachDetails) {
                // Check if the 'firstname' key is available in coachDetails
                $section['coach'] = isset($coachDetails['firstname']) ? $coachDetails['firstname'] . ' ' . $coachDetails['lastname'] : 'Coach Name Not Found';
            } else {
                // Handle the case when coach details are not found (optional)
                $section['coach'] = 'Coach Not Found';
            }
        }

        return $this->respond($data);
    }



   public function addData()
{
    $json = $this->request->getJSON();

    $data = [
        'name' => $json->name,
        'coach' => $json->coach->value, // Use the coach ID
        'quantity' => $json->quantity,
        'age_group' => $json->age_group,
    ];

    // Fetch coach details based on the provided coach ID
    // ...

    $sectionModel = new SectionModel();
    $r = $sectionModel->save($data);

    return $this->respond($r, 200);
}

}

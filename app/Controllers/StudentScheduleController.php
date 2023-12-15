<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentScheduleModel;
use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class StudentScheduleController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        //
    }
    public function getData()
    {
        $events = new StudentScheduleModel();
        $data = $events->findAll();

        // Replace audience IDs with concatenated names
        foreach ($data as &$event) {
            if (isset($event['audience']) && $event['audience'] !== 'All') {
                $audienceIds = explode(',', $event['audience']);
                $students = (new StudentModel())->find($audienceIds);

                if (!empty($students)) {
                    $names = array_map(function ($student) {
                        return $student['firstname'] . ' ' . $student['lastname'];
                    }, $students);

                    $event['audience'] = implode(', ', $names);
                }
            }
        }

        return $this->respond($data);
    }


    public function addData()
    {
        $json = $this->request->getJSON();

        $audience = $json->audience;

        if (!is_array($audience)) {
            $audience = [$audience];
        }

        // if (in_array('Students', $audience)) {
        // Audience contains Students
        $studentIds = array_filter($audience, fn ($value) => $value !== 'Students');

        if (empty($studentIds)) {
            return $this->fail('Invalid student ids');
        }

        $students = (new StudentModel())->find($studentIds);

        if (empty($students)) {
            return $this->fail('Invalid student ids');
        }

        $data = [
            'type' => $json->type,
            'description' => $json->description,
            'date' => $json->start,
        ];

        $scheduleModel = new StudentScheduleModel();
        foreach ($students as $student) {
            $data['audience'] = $student['id'];
            $scheduleModel->insert($data);
        }

        return $this->respond(['message' => 'Schedule createdssss successfully'], 200);
        // }

        // ...

        // return $this->respond(['message' => 'Schedules created successfully'], 200);
    }



    public function updateData($id = null)
    {
        $json = $this->request->getJSON();

        $data = [
            'type' => $json->type,
            'description' => $json->description,
            'date' => $json->start,
            'audience' => $json->audience,
        ];

        $ScheduleModel = new StudentScheduleModel();
        $r = $ScheduleModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $ScheduleModel = new StudentScheduleModel();
        $r = $ScheduleModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }
}

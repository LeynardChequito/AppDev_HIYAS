<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\SectionModel;
use App\Models\AccountModel;
use App\Models\ParentsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class StudentController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        //
    }

    public function getData()
    {
        $studentModel = new StudentModel();
        $students = $studentModel->findAll();

        // Replace foreign key IDs with corresponding names
        foreach ($students as &$student) {
            // Fetch section name if it exists
            if (!empty($student['section'])) {
                $sectionModel = new SectionModel();
                $section = $sectionModel->find($student['section']);
                // Update the 'section' field only if the section is found
                if ($section) {
                    $student['section'] = $section['name'];
                }
            }
            else{
                $student['section'] = "Not assigned";
            }

            // Fetch coach name
            // $coachModel = new CoachModel();
            // $coach = $coachModel->find($student['coach']);
            // $student['coach'] = $coach['firstname'] . ' ' . $coach['lastname'];

            // Fetch parent/guardian name
            $parentsModel = new ParentsModel();
            $parent = $parentsModel->find($student['parent_guardian']);
            $student['parent_guardian'] = $parent['firstname'] . ' ' . $parent['lastname'];
        }

        return $this->respond($students);
    }


    public function getDataById($id)
    {
        $studentModel = new StudentModel();
        $student = $studentModel->find($id);

        if ($student) {
            // Fetch section name
            $sectionModel = new SectionModel();
            $section = $sectionModel->find($student['section']);
            $student['section'] = $section['name'];

            // Fetch coach name
            // $coachModel = new CoachModel();
            // $coach = $coachModel->find($student['coach']);
            // $student['coach'] = $coach['firstname'] . ' ' . $coach['lastname'];

            // Fetch parent/guardian name
            $parentsModel = new ParentsModel();
            $parent = $parentsModel->find($student['parent_guardian']);
            $student['parent/guardian'] = $parent['firstname'] . ' ' . $parent['lastname'];

            return $this->respond($student);
        } else {
            return $this->failNotFound('Student not found');
        }
    }



    public function addData()
    {
        $json = $this->request->getJSON();

        $data = [
            'firstname' => $json->firstname,
            'lastname' => $json->lastname,
            'age' => $json->age,
            'birthday' => $json->birthday,
            'gender' => $json->gender,
            'address' => $json->address,
            'contact_info' => $json->contact_info,
            'parent_guardian' => $json->parent_guardian->value,
            // 'coach' => $json->coach->value,
            'section' => $json->section->value,
            'sponsor' => $json->sponsor,
            'id_number' => $json->id_number,
            'school' => $json->school,
            'grade_level' => $json->grade_level,
            'fam_number' => $json->fam_number,
            'staff' => $json->staff,
            'height' => $json->height,
            'weight' => $json->weight,
        ];

        $StudentModel = new StudentModel(); // Assuming you have an AccountModel
        $r = $StudentModel->save($data);
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
            'gender' => $json->gender,
            'address' => $json->address,
            'contact_info' => $json->contact_info,
            'parent_guardian' => $json->parent_guardian->value,
            // 'coach' => $json->coach->value,
            'section' => $json->section->value,
            'sponsor' => $json->sponsor,
            'id_number' => $json->id_number,
            'school' => $json->school,
            'grade_level' => $json->grade_level,
            'fam_number' => $json->fam_number,
            'staff' => $json->staff,
            'height' => $json->height,
            'weight' => $json->weight,
        ];

        $StudentModel = new StudentModel();
        $r = $StudentModel->update($id, $data); // Assuming your primary key field is 'id'

        return $this->respond($r, 200);
    }

    public function deleteData($id = null)
    {
        $StudentModel = new StudentModel();
        $r = $StudentModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }

    public function getTotalStudents()
    {
        $studentModel = new StudentModel();
        $totalStudents = $studentModel->countAll(); // Assuming your studentModel has the countAll method


        return $this->respond(['totalStudents' => $totalStudents]);
    }
}




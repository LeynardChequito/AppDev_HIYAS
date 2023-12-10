<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StudentAttendanceModel;
use App\Models\StudentModel;
use App\Models\SectionModel;

class AttendanceController extends ResourceController
{
    use ResponseTrait;

    public function studentAttendance()
    {
        // Fetch student attendance data
        $attendanceModel = new StudentAttendanceModel();
        $attendanceData = $attendanceModel->findAll();

        // Replace foreign key IDs with corresponding names
        foreach ($attendanceData as &$attendance) {

            // Fetch student name
            $studentModel = new StudentModel();
            $student = $studentModel->find($attendance['student']);
            $attendance['student'] = $student['firstname'] . ' ' . $student['lastname'];

            $sectionModel = new SectionModel();
            $section = $sectionModel->find($student['section']);
            $student['section'] = $section['name'];
            $attendance['section'] = $student['section'];
        }

        return $this->respond($attendanceData);
    }

    public function addStudentAttendance()
    {
        $json = $this->request->getJSON();

        $data = [
            'student' => $json->student->value,
            'status' => $json->status,
            'date' => $json->date,
            'event_type' => $json->event_type,
        ];

        $AttendanceModel = new StudentAttendanceModel(); // Assuming you have an AccountModel
        $r = $AttendanceModel->save($data);
        return $this->respond($r, 200);
    }


    public function updateStudentAttendance($id = null)
    {
        $json = $this->request->getJSON();

        $data = [
            'student' => $json->student->value,
            'status' => $json->status,
            'date' => $json->date,
            'event_type' => $json->event_type,
        ];

        $AttendanceModel = new StudentAttendanceModel();
        $r = $AttendanceModel->update($id, $data);

        return $this->respond($r, 200);
    }

    public function deleteStudentAttendance($id = null)
    {
        $AttendanceModel = new StudentAttendanceModel();
        $r = $AttendanceModel->delete($id); // Assuming your primary key field is 'id'

        return $this->respondDeleted();
    }
    public function createAttendance()
    {
        $json = $this->request->getJSON();
    
        // Fetch students for the selected section
        $studentModel = new StudentModel();
        $students = $studentModel->where('section', $json->section->value)->findAll();
    
        // Create attendance for each student
        $attendanceModel = new StudentAttendanceModel();
        foreach ($students as $student) {
            $data = [
                'date' => $json->date,
                'student' => $student['id'],
            ];
            $attendanceModel->save($data);
        }
    
        return $this->respond(['message' => 'Attendance created successfully'], 200);
    }
    

    public function getStudentsForAttendance($sectionId)
    {
        $studentModel = new StudentModel();
        $students = $studentModel->where('section', $sectionId)->findAll();

        return $this->respond($students);
    }
}

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
}

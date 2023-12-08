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
    public function studentAttendance()
    {
        $studentAttendance = new StudentAttendanceModel();
        $studentsModel = new StudentModel();
        $sectionsModel = new SectionModel();

        // Fetch student attendance data
        $attendanceData = $studentAttendance->findAll();

        // Fetch student details
        $students = $studentsModel->findAll();

        // Create a map for student IDs to student details
        $studentsMap = [];
        foreach ($students as $student) {
            $studentsMap[$student['id']] = $student;
        }

        // Fetch section details
        $sections = $sectionsModel->findAll();

        // Create a map for section IDs to section details
        $sectionsMap = [];
        foreach ($sections as $section) {
            $sectionsMap[$section['id']] = $section;
        }

        // Replace student IDs with student details in attendance data
        foreach ($attendanceData as &$attendance) {
            if (isset($studentsMap[$attendance['student']])) {
                $studentDetails = $studentsMap[$attendance['student']];
                $attendance['student'] = $studentDetails['firstname'] . ' ' . $studentDetails['lastname'];
            }

            // Replace section IDs with section details in attendance data
            if (isset($sectionsMap[$attendance['section']])) {
                $sectionDetails = $sectionsMap[$attendance['section']];
                $attendance['section'] = $sectionDetails['name'];
            }
        }

        return $this->respond($attendanceData);
    }
}

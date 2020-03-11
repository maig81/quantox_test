<?php

namespace Quantox;
use Spatie\ArrayToXml\ArrayToXml;

class SchoolBoard
{
    private $id;
    private $name;
    private $type;
    private $calculateFunction;

    public function __construct(int $id)
    {
        $dbBoard = $this->fetchUserFromDatabase($id);
        $this->id = $dbBoard['id'];
        $this->name = $dbBoard['name'];
        $this->type = $dbBoard['type'];
        $this->calculateFunction = $dbBoard['type'] . 'calculate';
    }

    private function fetchUserFromDatabase(int $id)
    {
        $db = new Database();
        $student = $db->connection->queryFirstRow('SELECT * FROM school_board WHERE id=%s', $id);
        if (is_array($student)) {
            return $student;
        }
        return [];
    }

    public function getStudentReport(Student $student)
    {
        $calculateFunction = $this->type . 'GetRaport';
        return $this->$calculateFunction($student);
    }

    private function csmGetRaport(Student $student)
    {
        $averageGrades = Student::getAverageGrade($student->grades);
        $pass = ($averageGrades >= 7) ? 'Pass' : 'Fail';
        $report = [
            'id' => $student->id,
            'name' => $student->name,
            'grades' => implode(', ', $student->grades),
            'average' => $averageGrades,
            'final_result' => $pass
        ];
        return json_encode($report);
    }

    private function csmbGetRaport(Student $student)
    {
        $grades = $student->grades;
        if (count($grades) > 2) {
            $grades = sort($grades);
            $grades = array_shift($grades);
        }
        $average = Student::getAverageGrade($grades);
        $pass = ($student->getBiggestGrade() > 8) ? 'Pass' : 'Fail';

        $report = [
            'id' => $student->id,
            'name' => $student->name,
            'grades' => implode(', ', $grades),
            'average' => $average,
            'final_result' => $pass
        ];
        return ArrayToXml::convert($report);
    }
}

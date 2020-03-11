<?php

namespace Quantox;

class Student
{
    public $id;
    public $name;
    public $grades;
    public $schoolBoardID;

    public function __construct(int $id)
    {
        $dbStudent = $this->fetchStudentFromDatabase($id);
        $this->id = $dbStudent['id'];
        $this->name = $dbStudent['name'];
        $this->grades = $this->getGrades($dbStudent['grades']);
        $this->schoolBoardID = $dbStudent['schoolBoardID'];
    }

    public function schoolBoard()
    {
        return new SchoolBoard($this->schoolBoardID);
    }

    public function getGrades($grades)
    {
        if ($grades) {
            return explode(',', $grades);
        }
        return [0];
    }

    public static function getAverageGrade(array $grades)
    {
        $average = array_sum($grades)/count($grades);
        return $average;
    }

    public function getBiggestGrade()
    {
        return max($this->grades);
    }

    public function getReport()
    {
        return $this->schoolBoard()->getStudentReport($this);
    }

    private function fetchStudentFromDatabase(int $id)
    {
        $db = new Database();
        $student = $db->connection->queryFirstRow('SELECT * FROM students WHERE id=%s', $id);
        if (is_array($student)) {
            return $student;
        }
        die ("No such student");
    }
}

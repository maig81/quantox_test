<?php

namespace Quantox;

class Student
{
    private $id;
    private $name;
    private $grades;
    private $schoolBoardID;

    public function __construct(int $id)
    {
        $dbStudent = $this->fetchStudentFromDatabase($id);
        $this->id = $dbStudent['id'];
        $this->name = $dbStudent['name'];
        $this->grades = $dbStudent['grades'];
        $this->schoolBoardID = $dbStudent['schoolBoardID'];
    }

    public function schoolBoard()
    {
        return new SchoolBoard($this->schoolBoardID);
    }

    public function getGrades()
    {
        if ($this->grades) {
            return explode(',', $this->grades);
        }
        return [0];
    }

    public function getAverageGrade()
    {
        $grades = $this->getGrades();
        $average = array_sum($grades)/count($grades);
        return $average;

    }

    private function fetchStudentFromDatabase(int $id)
    {
        $db = new Database();
        $student = $db->connection->queryFirstRow('SELECT * FROM students WHERE id=%s', $id);
        if (is_array($student)) {
            return $student;
        }
        return [];
    }
}

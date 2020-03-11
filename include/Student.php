<?php

namespace Quantox;

class Student
{
    private $id;
    private $name;
    private $grades;

    public function __construct(int $id)
    {
        $dbStudent = $this->fetchUser($id);
        $this->id = $dbStudent['id'];
        $this->name = $dbStudent['name'];
        $this->grades = $dbStudent['grades'];
    }

    private function fetchUser($id)
    {
        return [
            'id' => $id,
            'name' => 'Test user',
            'grades' => [1, 5, 10]
        ];
    }
}

<?php

namespace Quantox;

class SchoolBoard
{
    private $id;
    private $name;

    public function __construct(int $id)
    {
        $dbBoard = $this->fetchUserFromDatabase($id);
        $this->id = $dbBoard['id'];
        $this->name = $dbBoard['name'];
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
}

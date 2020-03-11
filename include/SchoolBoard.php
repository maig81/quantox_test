<?php

namespace Quantox;

class SchoolBoard
{
    private $id;
    private $name;

    public function __construct(int $id)
    {
        $dbBoard = $this->fetchBoard($id);
        $this->id = $dbBoard['id'];
        $this->name = $dbBoard['name'];
    }

    private function fetchBoard($id)
    {
        return [
            'id' => $id,
            'name' => 'Test user'
        ];
    }
}

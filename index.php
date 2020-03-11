<?php

require("vendor/autoload.php");
use Quantox\Student;
use Quantox\SchoolBoard;

    $student = new Student($_GET['student']);
    echo $student->getReport();

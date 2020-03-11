<?php

require("vendor/autoload.php");
use Quantox\Student;

$student = (int) $_GET['student'];
if (!isset($student) || !is_int($student)){
    return "Student not found";
}
$student = new Student($_GET['student']);
echo $student->getReport();

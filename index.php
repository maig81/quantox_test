<?php

require("vendor/autoload.php");
use Quantox\Student;

$student = new Student($_GET['student']);
echo $student->getReport();

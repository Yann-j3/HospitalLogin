<?php

ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

require_once __DIR__."/app/librairies/Database.php";
require_once __DIR__."/app/models/Doctor.php";
require_once __DIR__."/app/controllers/Doctors.php";
require_once __DIR__."/app/models/Patient.php";
require_once __DIR__."/app/controllers/Patients.php";

$pc = new Patients;
$pc->register();


/*

$dc->getNamefromEmail("marie@orange.fr");
$db = new Database;
$doctor = new Doctor;
var_dump($doctor->fetchDoctorByEmail("marie@orange.fr"));
var_dump($doctor->fetchDoctorByEmail("imaginary@orange.fr"));
?> <br/><br/> <?php
var_dump($doctor->getDoctorById(4));
*/
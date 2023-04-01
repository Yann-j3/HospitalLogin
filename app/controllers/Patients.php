<?php
require_once __DIR__."/../librairies/Controller.php";
require_once __DIR__."/../librairies/Database.php";
define("toLoginPatientReg", "http://localhost/Login/app/views/loginPatient.php");

class Patients extends Controller {

    private $patientModel; 

    public function __construct() {
        $this->patientModel = $this->loadModel("Patient");
    }

    public function addPatient(string $username, string $password, string $email, string $specialty){
        $this->patientModel->addPatient($username, $password, $email, $specialty);
    }

    public function checkAuth(string $email, string $password){
        return $this->patientModel->checkAuth($email, $password);
    }

    public function emailAlreadyUsed(string $email) {
        return $this->patientModel->emailAlreadyUsed($email);
    }

    public function getNamefromEmail(string $email) {
        return $this->patientModel->getNamefromEmail($email);
    }

    public function passwordTooShort(string $password) {
        return $this->patientModel->passwordTooShort($password);
    }

    public function register() {
        header('Location: ' . toLoginPatientReg);
    }
}
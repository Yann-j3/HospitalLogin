<?php
require_once __DIR__."/../librairies/Controller.php";
require_once __DIR__."/../librairies/Database.php";
define("toLoginDoctorReg", "http://localhost/Login/app/views/loginDoctor.php");

class Doctors extends Controller {

    private $doctorModel; 

    public function __construct() {
        $this->doctorModel = $this->loadModel("Doctor");
    }

    public function addDoctor(string $username, string $password, string $email, string $specialty){
        $this->doctorModel->addDoctor($username, $password, $email, $specialty);
    }

    public function checkAuth(string $email, string $password){
        return $this->doctorModel->checkAuth($email, $password);
    }

    public function emailAlreadyUsed(string $email) {
        return $this->doctorModel->emailAlreadyUsed($email);
    }

    public function getNamefromEmail(string $email) {
        return $this->doctorModel->getNamefromEmail($email);
    }

    public function getIdfromName(string $name) {
        return $this->doctorModel->getIdfromName($name);
    }

    public function passwordTooShort(string $password) {
        return $this->doctorModel->passwordTooShort($password);
    }

    public function register() {
        header('Location: ' . toLoginDoctorReg);
    }
}
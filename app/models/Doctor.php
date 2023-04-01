<?php
class Doctor {
    private $idDoctor;
    private $Name;
    private $email;
    private $password;
    private $specialty;
    private $db;
    private $table = "Doctor";

    public function __construct() {
        $this->db = new Database();
    }

    public function addDoctor(string $username, string $password, string $email, string $specialty){
        $sql = "INSERT INTO " . $this->table . " VALUES (0,\"".$username."\",\"". $password."\",\"".$email."\",\"".$specialty."\")";
        $query = $this->db->prepare($sql);
        $this->db->single();
    }

    public function checkAuth(string $email, string $password){
        $sql = "SELECT count(*) FROM " . $this->table . " WHERE email = \"" . $email . "\" AND password = \"" . base64_encode($password) . "\"";
        $query = $this->db->prepare($sql);
        $ret = $this->db->single();
        if($ret[0] == 0 ) {return FALSE;}
        else { return TRUE; }
    }

    public function emailAlreadyUsed(string $email) {
        $sql = "SELECT count(*) FROM " . $this->table . " WHERE email = \"" . $email . "\"";
        $query = $this->db->prepare($sql);
        $ret = $this->db->single();
        if($ret[0] == 0 ) {return FALSE;}
        else { return TRUE; }
    }

    public function passwordTooShort(string $password) {
        if(strlen($password)<7) {return TRUE;}
        else {return FALSE;}
    }

    public function getNamefromEmail(string $email) {
        $sql = "SELECT name FROM " . $this->table . " WHERE email = \"" . $email . "\"";
        $query = $this->db->prepare($sql);
        $result = $this->db->single();
        return $result['name'];
    }

    public function getIdfromName(string $name) {
        $sql = "SELECT idDoctor FROM " . $this->table . " WHERE name = \"" . $name . "\"";
        $query = $this->db->prepare($sql);
        $result = $this->db->single();
        if($result[0] == 0 ) {return FALSE;}
        else { return $result['idDoctor']; }
    }

    public function fetchDoctorByEmail(string $email) {
        $query = "SELECT * FROM Doctor WHERE email = \"" . $email . "\"";
        $this->db->prepare($query);
        $ret = $this->db->resultSet();
        if($this->db->rowCount()==0) {return FALSE;}
        else { return TRUE; }
    }

    public function getDoctorById(int $id) {
        $query = "SELECT * FROM Doctor WHERE idDoctor = \"" . $id . "\"";
        $this->db->prepare($query);
        return ($this->db->resultSet());
    }

}
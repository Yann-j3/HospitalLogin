<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Screen</title>
        <link rel="stylesheet" href="loginScreen.css">
    </head>
    <?php
    session_start();

    ini_set('display_errors','1');
    ini_set('display_startup_errors','1');
    error_reporting(E_ALL);

    require_once __DIR__."/../librairies/Database.php";
    require_once __DIR__."/../helpers/Session_helper.php";
    require_once __DIR__."/../helpers/url_helper.php";
    require_once __DIR__."/../controllers/Doctors.php";
    $doctable = new Doctors;
    if (!(isset($errorMsg))) {$errorMsg = "";}

    if((isset($_POST['patientB']))){
        redirect("loginPatient.php");
        exit();
    }

    if((isset($_POST['submitLogin']))){
        if($doctable->checkAuth($_POST['email'], $_POST['password'])) {
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['password'] = base64_encode($_POST['password']);
            $_SESSION['name'] = $doctable->getNamefromEmail($_POST['email']);
        }
        else{
            $errorMsg = "Wrong email or password!";
            $retryLogin = TRUE;
        }
    }

    if(isLoggedIn())  {
        ?>
        <form action="logoutDoctor.php" method="post">                          
        <label><b>You are logged in as <?php echo($_SESSION['name']); ?>.</b></label>
        <input type="submit" id='submit' value='LOGOUT'>
        </form>
        <br/><br/>
        <?php
        exit();
        }
    

    if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email'])){
        if ($doctable->emailAlreadyUsed($_POST['email'])) {
            $errorMsg="This email address is already being used!";
        }
        else if($doctable->passwordTooShort($_POST['password'])) {
            $errorMsg="The password must be longer than 6 characters!";
        }
        else {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['password'] = base64_encode($_POST['password']);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['specialty'] = "";
            if (isset($_POST['specialty'])) {$_SESSION['specialty'] = $_POST['specialty']; }
            $doctable->addDoctor($_SESSION['name'], $_SESSION['password'], $_SESSION['email'], $_SESSION['specialty']);
        }
    }

    if(isset($_POST['loginB']) || (isset($retryLogin) && $retryLogin)) {
        if (isset($retryLogin)) {$retryLogin = FALSE;}
        ?>
        <h1> Log in (doctor) : </h1>
        <form action="loginDoctor.php" method="post">
            <label><b>Email :</b></label>
            <input type="text" placeholder="Enter email" name="email" required>
            <label><b>Password :</b></label>
            <input type="password" placeholder="Enter password" name="password" required>            
            <p style="color: red; font-weight: bold; text-align: center;"><?php echo $errorMsg; ?></p>
            <br/>  
            <input type="submit" name='submitLogin' id='submit' value='SUBMIT'>
        </form>
    <?php
    }
    else
    {    
    ?>

<h1> Create a doctor account : </h1>
<form action="loginDoctor.php" method="post">
<label><b>Name :</b></label>
<input type="text" placeholder="Enter name" name="name" required>
<label><b>Email :</b></label>
<input type="text" placeholder="Enter email" name="email" required>
<label><b>Password :</b></label>
<input type="password" placeholder="Enter password" name="password" required>
<label><b>Specialty (optional) :</b></label>
<input type="text" placeholder="Enter specialty" name="specialty" >
<p style="color: red; font-weight: bold; text-align: center;"><?php echo $errorMsg; ?></p>
<br/>                           
<input type="submit" name='signupB' id='submit' value='SUBMIT'>
</form>

<h1> You already have an account ? Log in here : </h1>
<form action="loginDoctor.php" method="post">
<input type="submit" name='loginB' id='submit' value='LOG IN'>
</form>

<h1> You are not a doctor ? Login as a patient there : </h1>
<form action="loginDoctor.php" method="post">
<input type="submit" name='patientB' id='submit' value='PATIENT'>
</form>

   <?php }
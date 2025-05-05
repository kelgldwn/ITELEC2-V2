<?php
 
 require_once __DIR__.'/../../../database/dbconnection.php';
 include_once __DIR__.'/../../../config/settings-configuration.php';
 require_once __DIR__.'/../../../src/vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 
 
 class ADMIN{       
     private $conn;
     private $settings;
     private $smtp_email;
     private $smtp_password;

     public function __construct()
     {

         $this->settings = new SystemConfig();
         $this->smtp_email = $this->settings->getSmtpEmail();
         $this->smtp_password = $this->settings->getSmtpPassword();   

         $database = new Database();
         $this->conn = $database->dbConnection();
     }

     public function sendOtp($otp, $email){
         if($email == NULL){
            echo "<script>alert('No email Found!.'); window.location.href = '../../../';</script>";
            exit;
         }else{
            $stmt = $this->runQuery("SELECT * FROM user WHERE email = :email");
            $stmt->execute(array(":email" => $email)); 
            $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() > 0){
            echo "<script>alert('Email Already taken. Please try another one!'); window.location.href = '../../../';</script>";
            exit;
            }else{
                $_SESSION['OTP'] = $otp;

                $subject = "OTP VERIFICATION";
            }
         }
     }
 
     public function addAdmin($csrf_token, $username, $email, $password){
 
         $stmt = $this->runQuery("SELECT * FROM user WHERE email = :email");
         $stmt->execute(array(":email" => $email));
         
         if($stmt->rowCount() > 0){
             echo "<script>alert('Email already exists.'); window.location.href = '../../../';</script>";
             exit;
         }
         
         if(!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)){
             echo "<script>alert('Invalid CSRF Token.'); window.location.href = '../../../'; </script>";
             exit;
         }
 
         unset($_SESSION['csrf_token']);
         
         //$hash_password = password_hash($password, PASSWORD_DEFAULT);
         $hash_password = md5($password);
 
         $stmt = $this->runQuery('INSERT INTO user (username, email, password) VALUES (:username, :email, :password)');
         $exec = $stmt->execute(array(
             ":username" => $username,
             ":email" => $email,
             ":password" => $hash_password
         ));
 
         if($exec){
             echo "<script>alert('Admin Added Successfully.'); window.location.href = '../../../';</script>";
             exit;
         }else{
             echo "<script>alert('Invalid CSRF Token.'); window.location.href = '../../../';</script>";
             exit;
         }
 
     }
 
 
 
     public function adminSignin($email, $password, $csrf_token){
         try{
             if(!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)){
                 echo "<script>alert('Invalid CSRF Token.'); window.location.href = '../../../';</script>";
                 exit;
             }
             unset($_SESSION['csrf_token']);
 
             $stmt = $this->runQuery("SELECT * FROM user WHERE email = :email");
             $stmt->execute(array(":email" => $email));
             $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
 
             if($stmt->rowCount() == 1 && $userRow['password'] == md5($password)){
                 $activity = "Has Successfully Signed In";
                 $user_id = $userRow['id'];
                 $this->logs($activity, $user_id);
 
                 $_SESSION['adminSession'] = $user_id;
                 echo "<script>alert('Welcome.'); window.location.href = '../';</script>";
                 exit;
             }else{
                 echo "<script>alert('Invalid Credentials.'); window.location.href = '../../../';</script>";
                 exit;
             }
 
         }catch (PDOException $ex){
             echo $ex->getMessage();
 
         }
         
         
     }
 
 
 
     public function adminSignout(){
         unset($_SESSION['adminSession']); 
         echo "<script>alert('Sign Out Successfully.'); window.location.href = '../../../';</script>";
         exit;
     }


     function send_email($email, $message, $subject, $smtp_email, $smtp_password){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"
        $mail->Host = "smtp.gmail.com"
        $mail->Port = 587;
        $mail->addAddress($email);
        $mail->Username = $smtp_email;
        $mail->Password = $smtp_password;
        $mail->SetFrom($smtp_email, "Kelmar");
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->Send();

     }
 
 
 
     public function logs($activity, $user_id){
         $stmt = $this->runQuery("INSERT INTO logs (user_id, activity) VALUES (:user_id, :activity)");
         $stmt->execute(array(":user_id" => $user_id, ":activity" => $activity));
     }
 
 
 
     public function isUserLoggedIn(){
 
         if(isset($_SESSION['adminSession'])){
             return true;
         }
 
     }
 
 
 
     public function redirect(){
         echo "<script>alert('Admin must log in first.'); window.location.href = '../../../';</script>";
         exit;
     }
 
 
 
     
     public function runQuery($sql){
         $stmt = $this->runQuery($sql);
         return $stmt;
     }
 
 }
 
 
 
 if (isset($_POST['btn-signup'])){

    $_SESSION['not_verify_csrf_token'] = trim($_POST['csrf_token']);
    $_SESSION['not_verify_username'] = trim($_POST['username']);
    $_SESSION['not_verify_email'] = trim($_POST['email']);
    $_SESSION['not_verify_password'] = trim($_POST['password']);
    
    $email = trim($_POST['email']);
    $otp = rand(100000, 999999);

    $addAdmin = new ADMIN();
    $addAdmin->sendotp($otp, $email);
 }
 
 if(isset($_POST['btn-signin'])){
     $csrf_token = trim($_POST['csrf_token']);
     $email = trim($_POST['email']);
     $password = trim($_POST['password']);
 
     $adminSignin = new ADMIN();
     $adminSignin->adminSignin($email, $password, $csrf_token);
 }
 
 if(isset($_GET['admin_signout'])){
     $adminSignout = new ADMIN();
     $adminSignout->adminSignout();
 }
 
 
 ?>
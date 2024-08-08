<?php 


class User{
    public $connection;
    public function __construct()
    {
        $connect = new Config();
        $this->connection = $connect->connection();
    }

    public function signup($fullname, $email, $matNo, $gender, $password, $cpassword){
        $years = date("Y");
        $yearSearch = [];
        $found = 'false';
        for ($i=0; $i < 5 ; $i++) { 
            $yearSearch[]= $years - $i;
        }
        foreach ($yearSearch as $value) {
            if (str_contains($matNo, $value)) {
                $found = 'true';
                break;
            }
        }
        if (strlen($fullname) < 3) {
            $_SESSION['signup_error'] = 'Please input your fullname';
            echo "<script>window.history.back();</script>";
        }elseif($found == 'false') {
            $_SESSION['signup_error'] = 'You are ineligible to apply';
            echo "<script>window.history.back();</script>";
        }elseif(empty($gender)) {
            $_SESSION['signup_error'] = 'Please select a gender';
            echo "<script>window.history.back();</script>";
        }elseif($password != $cpassword) {
            $_SESSION['signup_error'] = 'Password mismatch, please check your password';
            echo "<script>window.history.back();</script>";
        }else{
            $prepared = "INSERT INTO `user`(`fullname`, `email`, `matNo`, `gender`, `password`, `cpassword`, `status`) VALUES ('$fullname','$email','$matNo', '$gender','$password','$cpassword','pending')";
            $sql = $this->connection->query($prepared);
            if($sql == true){
                $_SESSION['signup_success'] = 'Sign up successfully. Sign in to continue';
                header('location: http://localhost/hostel/login.php');
            }else{
                $_SESSION['signup_error'] = 'sign up failed';
                echo "<script>window.history.back();</script>";
            }
        }
    }
    public function signin($identity, $password){
        $prepared = "SELECT * FROM `user` WHERE email = '$identity' || matNo = '$identity'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->fetch_assoc();
            
            if ($password == $userdetails['password']) {
                $_SESSION['signin_success'] = 'signed in successfully';
                $_SESSION['userid'] = $userdetails['id'];
                if($userdetails['id'] == 1){
                    header('location: http://localhost/hostel/php/view/admin/');
                }else{
                    header('location: http://localhost/hostel/php/view/dashboard/');
                }

            }else{
                $_SESSION['signin_error'] = 'wrong login details';
                echo "<script>window.history.back();</script>";
            }
        
        }else{
            $_SESSION['signin_error'] = 'this email or Mat No. is no registered';
            echo "<script>window.history.back();</script>";
        }
    }
    public static function authenticate(){
        $userAuth = $_SESSION['userid'];
        if ($userAuth == false) {
            header('location: http://localhost/hostel/login.php');
        }
    }
    public function users(){
        $prepared = "SELECT * FROM `user` WHERE id != 1";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->num_rows;
            return $userdetails;
        }
    }
    public function userDetails($user_id){
        $prepared = "SELECT * FROM `user` WHERE id = '$user_id'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->fetch_assoc();
            return $userdetails;
        }
    }
}
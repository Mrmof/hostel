<?php 

class Application{
    public $connection;
    public function __construct()
    {
        $connect = new Config();
        $this->connection = $connect->connection();
    }

    public function hostelApplication($fullname, $matNo, $department, $level, $schoolFees, $hostelFees, $user_id){
 
        if (empty($fullname)) {
            $_SESSION['application_error'] = 'Please input your fullname';
            echo "<script>window.history.back();</script>";
        }elseif (empty($matNo)) {
            $_SESSION['application_error'] = 'Please input your matriculation number';
            echo "<script>window.history.back();</script>";
        }elseif (empty($department)) {
            $_SESSION['application_error'] = 'Please input your department name';
            echo "<script>window.history.back();</script>";
        }elseif (empty($level)) {
            $_SESSION['application_error'] = 'Please input your level';
            echo "<script>window.history.back();</script>";
        }elseif ($schoolFees['name'] == '' ) {
            $_SESSION['application_error'] = 'Please upload your school fees receipt';
            echo "<script>window.history.back();</script>";
        }elseif ($hostelFees['name'] == '' ) {
            $_SESSION['application_error'] = 'Please upload your hostel fees receipt';
            echo "<script>window.history.back();</script>";
        }else{
            $schoolFeesReceipt = $fullname."schoolfees".$schoolFees['name'];
            $hostelFeesReceipt = $fullname."hostelfees".$hostelFees['name'];
            $filepath1 = "../storage/".$schoolFeesReceipt;
            $filepath2 = "../storage/".$hostelFeesReceipt;
            $createdAt = date("Y-m-d");
            $prepared = "INSERT INTO `application`(`fullname`, `matNo`, `department`, `level`, `schoolfees`, `hostelfees`, `status`, `allocation`, `createdAt`, `user_id`) VALUES ('$fullname','$matNo','$department','$level','$schoolFeesReceipt','$hostelFeesReceipt','pending', 'false', '$createdAt', '$user_id')";
            $sql = $this->connection->query($prepared);
            if ($sql == true) {
                $_SESSION['application_success'] = 'done';
                move_uploaded_file($schoolFees['tmp_name'], $filepath1);
                move_uploaded_file($hostelFees['tmp_name'], $filepath2);
                header('location: http://localhost/hostel/php/view/dashboard/application.php');
            }

            
        }
    }
    public function applications(){
        $prepared = "SELECT * FROM `application`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $applications = $sql->num_rows;
            return $applications;
        }
    }
    public function approveapplication($id){
        $prepared = "UPDATE `application` SET `status`='approved' WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        if($sql == true){
            $_SESSION['approved_success'] = 'done';
            header('location: http://localhost/hostel/php/view/admin/application.php');
        }
    }
    public function pendingapplications(){
        $prepared = "SELECT * FROM `application` WHERE status = 'pending'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $applications = $sql->num_rows;
            return $applications;
        }
    }
    public function viewapplication(){
        $prepared = "SELECT * FROM `application` WHERE status = 'pending'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            foreach ($sql as $value) {
                echo '<div class="col-sm-12 col-md-3">
                        <div class="card p-2">
                            
                            <div class="card-header">
                                <div class="card-title">Fullname: '.$value['fullname'].' </div>
                            </div>
                            <div class="card-body">
                                <p>Mat No.: '.$value['matNo'].'</p>
                                <p>Department: '.$value['department'].' </p>
                                <p>Level: '.$value['level'].'</p>
                                <p>Date: '.$value['createdAt'].' </p>
                                <p>Status: '.$value['status'].' </p>
                            </div>
                            <div class="card-footer">
                                <img src="http://localhost/hostel/php/storage/'.$value['schoolfees'].'" alt="" class="img-fluid">
                                <img src="http://localhost/hostel/php/storage/'.$value['hostelfees'].'" alt="" class="img-fluid">
                            </div>
                            <a href="http://localhost/hostel/php/controller/approveapplication.php?id='.$value['id'].'" class="btn btn-success">Approve</a>
                            <a href="http://localhost/hostel/php/controller/dismissapplication.php?id='.$value['id'].'" class="btn btn-danger">Dismiss</a>

                        </div>
                    </div>';
            }
        }

    }
    public function viewapprovedapplication(){
        $prepared = "SELECT * FROM `application` WHERE status = 'approved'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            foreach ($sql as $value) {
                echo '<div class="col-sm-12 col-md-3">
                        <div class="card p-2">
                            
                            <div class="card-header">
                                <div class="card-title">Fullname: '.$value['fullname'].' </div>
                            </div>
                            <div class="card-body">
                                <p>Mat No.: '.$value['matNo'].'</p>
                                <p>Department: '.$value['department'].' </p>
                                <p>Level: '.$value['level'].'</p>
                                <p>Date: '.$value['createdAt'].' </p>
                                <p>Status: '.$value['status'].' </p>
                            </div>
                            <div class="card-footer">
                                <img src="http://localhost/hostel/php/storage/'.$value['schoolfees'].'" alt="" class="img-fluid">
                                <img src="http://localhost/hostel/php/storage/'.$value['hostelfees'].'" alt="" class="img-fluid">
                            </div>
                            <a href="http://localhost/hostel/php/controller/dismissapplication.php?id='.$value['id'].'" class="btn btn-danger">Dismiss</a>

                        </div>
                    </div>';
            }
        }

    }
    public function approvedforallocation(){
        $prepared = "SELECT * FROM `application` WHERE status = 'approved' && allocation = 'false' ORDER BY id DESC";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $i = 1;
            foreach ($sql as $value) {
                echo '<tr>
                        <td>'.$i++.'</td>
                        <td class="text-capitalize">'.$value['fullname'].'</td>
                        <td class="text-capitalize">'.$value['department'].'</td>
                        <td class="text-capitalize">'.$value['level'].'</td>
                        <td class="text-capitalize">'.$value['matNo'].'</td>
                        <td><a href="http://localhost/hostel/php/controller/allocation.php?id='.$value['id'].'&&user_id='.$value['user_id'].'" class="btn btn-primary">Allocate</td>
                    </tr>';
            }
        }

    }

}
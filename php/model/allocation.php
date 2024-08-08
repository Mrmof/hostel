<?php 


class Allocation extends User{
    public $connection;
    public function __construct()
    {
        $connect = new Config();
        $this->connection = $connect->connection();
    }
    public function genderHostel($gender){
        $prepared = "SELECT * FROM `hostel` WHERE genderSet = '$gender'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $HostelArray = [];
            foreach ($sql as $value) {
                $HostelArray[] = $value['id'];   
            }
            $hostelId = $HostelArray[rand(0, count($HostelArray)-1)];
            return $hostelId;
        }
        return null;
    }
    public function hostelName($hostelId){
        $prepared = "SELECT * FROM `hostel` WHERE id = '$hostelId'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $hostelName = $sql->fetch_assoc();
            
            return $hostelName['name'];
        }
        return null;
    }
    public function roomPicked($hostelId){
        $prepared = "SELECT * FROM `hostelspace` WHERE hostelId = '$hostelId'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $roomArray = [];
            foreach ($sql as $value) {
                $roomArray[] = $value['id'];   
            }
            $randomPick = $roomArray[rand(0, count($roomArray)-1)];
            return $randomPick;
        }else{
            $_SESSION['allocation_error'] = 'No room Available';
            return -1;
        }
    }
    public function roomNamePicked($roomChosen){
        $prepared = "SELECT * FROM `hostelspace` WHERE id = '$roomChosen'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $roomName = $sql->fetch_assoc();
            return $roomName['roomNo'];
        }
        return null;
    }
    public function department($id){
        $prepared = "SELECT * FROM `application` WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $department = $sql->fetch_assoc();
            return $department['department'];
        }
        return null;
    }
    public function level($id){
        $prepared = "SELECT * FROM `application` WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $level = $sql->fetch_assoc();
            return $level['level'];
        }
        return null;
    }
    public function checkIfUserAllocated($user_id){
        $prepared = "SELECT * FROM `allocation` WHERE id = '$user_id'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $found = 'true';
            return $found;
        }
        return null;
    }




        // user information
        // $userinfo = $this->userDetails($user_id);
        // $fullname = $userinfo['fullname'];
        // $gender = $userinfo['gender'];
        // $department = $this->department($id);
        // $level = $this->level($id);
        // $matNo = $userinfo['matNo'];
        // // gender of hostel
        // $hostelId = $this->genderHostel($gender);
        // // hostel Name
        // $hostelName = $this->hostelName($hostelId);
        // // this is the id of room chosen
        // $roomChosen = $this->roomPicked($hostelId);
        // //room name picked    
        // $roomNamePicked = $this->roomNamePicked($roomChosen);
        
        
       
        public function allocate($id, $user_id){
            // user information
            $userinfo = $this->userDetails($user_id);
            $fullname = $userinfo['fullname'];
            $gender = $userinfo['gender'];
            $department = $this->department($id);
            $level = $this->level($id);
            $matNo = $userinfo['matNo'];
        
            // gender of hostel
            $hostelId = $this->genderHostel($gender);
            if ($hostelId === null) {
                $_SESSION['allocation_error'] = 'No hostel available for this gender';
                echo "<script>window.history.back();</script>";
                return;
            }
        
            // hostel Name
            $hostelName = $this->hostelName($hostelId);
            if ($hostelName === null) {
                $_SESSION['allocation_error'] = 'Hostel name not found';
                echo "<script>window.history.back();</script>";
                return;
            }
        
            // this is the id of room chosen
            $roomChosen = $this->roomPicked($hostelId);
            if ($roomChosen < 0) {
                $_SESSION['allocation_error'] = 'No room available';
                echo "<script>window.history.back();</script>";
                return;
            }
        
            // room name picked
            $roomNamePicked = $this->roomNamePicked($roomChosen);
            if ($roomNamePicked === null) {
                $_SESSION['allocation_error'] = 'Room name not found';
                echo "<script>window.history.back();</script>";
                return;
            }
        
            // checking user allocation
            if ($this->checkIfUserAllocated($user_id)) {
                $_SESSION['exist_error'] = 'User has already been allocated';
                echo "<script>window.history.back();</script>";
                return;
            }else{

                $prepared = "INSERT INTO `allocation`(`fullname`, `matNo`, `department`, `level`, `room`, `hostel`, `user_id`) VALUES ('$fullname','$matNo','$department','$level','$roomNamePicked','$hostelName','$user_id')";
                $sql = $this->connection->query($prepared);
                if($sql == true){
                    $prepared1 = "UPDATE `application` SET `allocation`='true' WHERE id = '$id'";
                    $sql1 = $this->connection->query($prepared1);
                    $_SESSION['allocation_success'] = 'Room Allocated Successfully';
                    header('location: http://localhost/hostel/php/view/admin/allocation.php');
                }
            }
        
        
        

    }
    public function allocations(){
        $prepared = "SELECT * FROM `allocation` ORDER BY id DESC";
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
                        <td class="text-capitalize">'.$value['hostel'].'</td>
                        <td class="text-capitalize">'.$value['room'].'</td>
                    </tr>';
            }
        }

    }
    public function userallocation($user_id){
        $prepared = "SELECT * FROM `allocation` WHERE user_id = '$user_id'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
                $allocationdetails = $sql->fetch_assoc();
               
                echo '<div class="col-sm-12 col-md-4">
                        <div class="card p-2">
                            
                            <div class="card-header">
                                <div class="card-title">Fullname: '.$allocationdetails['fullname'].' </div>
                            </div>
                            <div class="card-body">
                                <p>Mat No.: '.$allocationdetails['matNo'].'</p>
                                <p>Department: '.$allocationdetails['department'].' </p>
                                <p>Level: '.$allocationdetails['level'].'</p>
                                <p>Hostel: '.$allocationdetails['hostel'].' </p>
                                <p>Room No.: '.$allocationdetails['room'].' </p>
                            </div>

                        </div>
                    </div>';
            }else{
                echo '<div class="col-sm-12 col-md-4">
                        <div class="card p-2">
                            
                            Not allocated yet. Check back later.

                        </div>
                    </div>';
            }

    }
    public function countallocations(){
        $prepared = "SELECT * FROM `allocation`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->num_rows;
            return $userdetails;
        }
    }
}
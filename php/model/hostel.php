<?php 

class Hostel{
    public $connection;
    public function __construct()
    {
        $connect = new Config();
        $this->connection = $connect->connection();
    }

    public function createHostel($name, $genderSet){
        
        
        if (empty($name)) {
            $_SESSION['application_error'] = 'Please input your name of hostel';
            echo "<script>window.history.back();</script>";
        }elseif (empty($genderSet)) {
            $_SESSION['application_error'] = 'Please select genderSet';
            echo "<script>window.history.back();</script>";
        }else{
            $prepared = "INSERT INTO `hostel`(`name`, `genderset`) VALUES ('$name','$genderSet')";
            $sql = $this->connection->query($prepared);
            if ($sql == true) {
                $_SESSION['hostel_success'] = 'done';
                header('location: http://localhost/hostel/php/view/admin/hostel.php');
            }

            
        }
    }
    public function viewhostel(){
        $prepared = "SELECT * FROM `hostel`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $i = 1;
            foreach ($sql as $value) {
                echo '<tr>
                        <td>'.$i.'</td>
                        <td class="text-capitalize">'.$value['name'].'</td>
                        <td class="text-capitalize">'.$value['genderset'].'</td>
                        <td><a href="http://localhost/hostel/php/controller/deletehostel.php?id='.$value['id'].'" class="text-danger">Delete</td>
                    </tr>';
                    $i++;
            }
            
        }
    }
    public function hosteloptions(){
        $prepared = "SELECT * FROM `hostel`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            foreach ($sql as $value) {
                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            };
            
        }
    }

    public function getHostelName($hostelId){
        $prepared = "SELECT * FROM `hostel` WHERE id = '$hostelId'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $hostelName = $sql->fetch_assoc();
            return $hostelName['name'];
            
        }
    }
    public function createHostelSpace($roomNo, $hostelId){
        $hostelName = $this->getHostelName($hostelId);
        if (empty($roomNo)) {
            $_SESSION['hostelspace_error'] = 'Please input a room number';
            echo "<script>window.history.back();</script>";
        }elseif (empty($hostelName)) {
            $_SESSION['hostelspace_error'] = 'Please select a hostel';
            echo "<script>window.history.back();</script>";
        }else{
            $prepared = "INSERT INTO `hostelspace`(`roomNo`, `hostelName`, `hostelId`) VALUES ('$roomNo','$hostelName','$hostelId')";
            $sql = $this->connection->query($prepared);
            if ($sql == true) {
                $_SESSION['hostelspace_success'] = 'done';
                header('location: http://localhost/hostel/php/view/admin/hostel.php');
            }
        }
        
    }
    public function viewrooms(){
        $prepared = "SELECT * FROM `hostelspace`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $i = 1;
            foreach ($sql as $value) {
                echo '<tr>
                        <td>'.$i.'</td>
                        <td class="text-capitalize">'.$value['roomNo'].'</td>
                        <td class="text-capitalize">'.$value['hostelName'].'</td>
                        <td><a href="http://localhost/hostel/php/controller/deletehostelspace.php?id='.$value['id'].'" class="text-danger">Delete</td>
                    </tr>';
                    $i++;
            }
            
        }
    }
    public function deletehostel($id){
        $prepared = "DELETE FROM `hostel` WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        if($sql == true){
            $prepared1 = "DELETE FROM `hostelspace` WHERE hostelId = '$id'";
            $sql1 = $this->connection->query($prepared1);
            $_SESSION['deletehostel_success'] = 'done';
            header('location: http://localhost/hostel/php/view/admin/hostel.php');
        }
    }
    public function deletehostelspace($id){
        $prepared = "DELETE FROM `hostelspace` WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        if($sql == true){
            $_SESSION['deletehostelspace_success'] = 'done';
            header('location: http://localhost/hostel/php/view/admin/hostel.php');
        }
    }
    public function rooms(){
        $prepared = "SELECT * FROM `hostelspace`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->num_rows;
            return $userdetails;
        }
    }
    public function hostels(){
        $prepared = "SELECT * FROM `hostel`";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $userdetails = $sql->num_rows;
            return $userdetails;
        }
    }

}
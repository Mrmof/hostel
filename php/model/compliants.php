<?php 


class Compliants{
    public $connection;
    public function __construct()
    {
        $connect = new Config();
        $this->connection = $connect->connection();
    }
    public function message($fullname, $roomNo, $message, $user_id){
        if (empty($fullname)) {
            $_SESSION['compliants_error'] = 'Please input your fullname';
            echo "<script>window.history.back();</script>";
        }elseif (empty($roomNo)) {
            $_SESSION['compliants_error'] = 'Please input your room No.';
            echo "<script>window.history.back();</script>";
        }elseif (empty($message)) {
            $_SESSION['compliants_error'] = 'Please input your compliants message';
            echo "<script>window.history.back();</script>";
        }else{
            $prepared = "INSERT INTO `complians`(`fullname`, `roomNo`, `message`, `status`, `action`) VALUES ('$fullname','$roomNo','$message','pending','')";
            $sql = $this->connection->query($prepared);
            if($sql == true){
                $_SESSION['compliants_success'] = 'Message sent successfully';
                header('location: http://localhost/hostel/php/view/dashboard/compliants.php');
            }else{
                $_SESSION['compliants_error'] = 'an error occurred';
                echo "<script>window.history.back();</script>";
            }
        }
        
    }
    public function resolvedmessage(){
        
        $prepared = "SELECT * FROM `complians` WHERE action = 'resolved'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $message = $sql->num_rows;
            return $message;
        }else{
            return 0;
        }
        
    }
    public function pendingmessage(){
        
        $prepared = "SELECT * FROM `complians` WHERE status = 'pending'";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $message = $sql->num_rows;
            return $message;
        }else{
            return 0;
        }
        
    }
    public function complaintsMessage(){
        $prepared = "SELECT * FROM `complians` ORDER BY id DESC";
        $sql = $this->connection->query($prepared);
        if($sql->num_rows > 0){
            $i = 1;
            foreach ($sql as $value) {
                echo '<tr>
                        <td>'.$i++.'</td>
                        <td class="text-capitalize">'.$value['fullname'].'</td>
                        <td class="text-capitalize">'.$value['roomNo'].'</td>
                        <td class="text-capitalize">'.$value['message'].'</td>';
                    if ($value['action'] == '') {
                        echo '<td><a href="http://localhost/hostel/php/controller/resolve.php?id='.$value['id'].'" class="btn btn-primary">Resolve</td>';
                    }else{
                        echo '<td class="text-success">Resolved</td>';
                    }
                        
                    echo '</tr>';
            }
        }

    }
    public function resolve($id){
        $prepared = "UPDATE `complians` SET `action`='resolved' WHERE id = '$id'";
        $sql = $this->connection->query($prepared);
        $_SESSION['resolve_success'] = 'Complian Resolved Successfully';
        header('location: http://localhost/hostel/php/view/admin/compliants.php');
    }
}
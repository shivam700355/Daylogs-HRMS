<?php include_once 'db-connect.php'; ?>
<?php
class Operations extends Database
{

    //Check uniqueness of User....
    public function check_user($mobile, $email)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_mobile = :u_mobile OR u_email=:u_email LIMIT 1");
        $stmt->execute(array(':u_mobile' => $mobile, ':u_email' => $email));
        return $stmt->rowCount();
    }

    //Add New user
    public function add_user($name, $mobile, $email, $password, $address, $district, $state, $pincode, $role, $cid, $u_id)
    {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->con->prepare("INSERT INTO users (u_name,u_mobile,u_email,u_password,u_address,u_district,u_state,u_pincode,u_role,u_designation,u_cid,u_added_by,u_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        if ($stmt->execute(array($name, $mobile, $email, $hash_pass, $address, $district, $state, $pincode, $role,$role, $cid, $u_id, '1')))
            return $this->con->lastInsertId();
        else
            return false;
    }

    //Update User status....
    public function update_user_status($user_id, $status)
    {
        $stmt = $this->con->prepare("UPDATE users SET u_status =:status WHERE u_id = :u_id ");
        $stmt->execute(array(':u_id' => $user_id, ':status' => $status));
        return true;
    }

    //Delete user.....
    public function delete_user($user_id)
    {
        $stmt = $this->con->prepare("DELETE  FROM users WHERE u_id = :user_id");
        $stmt->execute(array(':user_id' => $user_id));
        return true;
    }

    //Update Company status....
    public function update_client_status($c_id, $status)
    {
        $stmt = $this->con->prepare("UPDATE clients SET status =:status WHERE id = :id ");
        $stmt->execute(array(':id' => $c_id, ':status' => $status));
        return true;
    }

    
    //function for activity log
    function create_activity($user_id, $messsage, $type, $added_by)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");
        $stmt =  $this->con->prepare("INSERT INTO activity(u_id,message,type,added_by,device,created_at) VALUES(?,?,?,?,?,?)");
        $stmt->execute(array($user_id, $messsage, $type, $added_by, 'Browser', $date));
    }

    //function for creating login sessions
    function create_login_session($user_id, $user_name)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");
        $session = md5($date);
        $stmt =  $this->con->prepare("INSERT INTO sessions(u_id,u_name,u_device,u_session) VALUES(?,?,?,?)");
        $stmt->execute(array($user_id, $user_name, 'Browser', $session));
    }


    //function for checking client
    function check_client($c_email, $c_contact)
    {
        $stmt = $this->con->prepare("SELECT * FROM clients WHERE email = :email OR mobile=:mobile LIMIT 1");
        $stmt->execute(array(':email' => $c_email, ':mobile' => $c_contact));
        return $stmt->rowCount();
    }

    //function for adding client
    function add_client($c_name,$ca_name, $c_contact,$c_email,$c_website,$c_logo,$c_pan,$c_gst,$c_address,$c_district,$c_state,$c_pincode)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt =  $this->con->prepare("INSERT INTO clients(name,abb_name,mobile,email,website,image,pan,gst,address,district,state,pincode,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
       
        if ($stmt->execute(array($c_name,$ca_name, $c_contact,$c_email,$c_website,$c_logo,$c_pan,$c_gst,$c_address,$c_district,$c_state,$c_pincode,$date)))
            return $this->con->lastInsertId();
        else
            return false;
    }

}
?>
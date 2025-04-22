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
    public function add_new_user($name, $mobile, $email, $password, $address, $district, $state, $pincode, $role, $designation, $dob, $doj, $work_station, $cid, $u_id)
    {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->con->prepare("INSERT INTO users (u_name,u_mobile,u_email,u_password,u_address,u_district,u_state,u_pincode,u_role,u_designation,u_dob,u_doj,u_work_station,u_cid,u_added_by,u_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        if ($stmt->execute(array($name, $mobile, $email, $hash_pass, $address, $district, $state, $pincode, $role, $designation, $dob, $doj, $work_station, $cid, $u_id, '1')))
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

    //Update User status....
    public function update_holiday_status($h_id, $status)
    {
        $stmt = $this->con->prepare("UPDATE holidays SET status =:status WHERE id = :id ");
        $stmt->execute(array(':id' => $h_id, ':status' => $status));
        return true;
    }




    //Delete user.....
    public function delete_user($user_id)
    {
        $stmt = $this->con->prepare("DELETE  FROM users WHERE u_id = :user_id");
        $stmt->execute(array(':user_id' => $user_id));
        return true;
    }

    //function for activity log
    function create_activity($type, $messsage, $added_by)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");
        $stmt = $this->con->prepare("INSERT INTO activity(message,type,device,added_by,created_at) VALUES(?,?,?,?,?)");
        $stmt->execute(array($messsage, $type, 'Browser', $added_by, $date));
    }

    //function for activity log
    function create_login_session($c_id, $u_id, $sessions)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");
        $stmt = $this->con->prepare("INSERT INTO sessions(c_id,u_id,device,session,created_at) VALUES(?,?,?,?,?)");
        $stmt->execute(array($c_id, $u_id, 'Browser', $sessions, $date));
    }

    //function for creating login sessions
    function logout($u_id, $session)
    {
        $stmt = $this->con->prepare("DELETE FROM sessions WHERE u_id=:u_id AND session=:session");
        $stmt->execute(array(':u_id' => $u_id, ':session' => $session));
        return true;
    }

    public function add_holiday($h_name, $h_date, $h_leaves, $c_id, $h_type, $h_desc, $added_by)
    {
        $stmt = $this->con->prepare("INSERT INTO holidays (h_name, h_date, h_leaves, c_id, h_type, h_desc, added_by) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute(array($h_name, $h_date, $h_leaves, $c_id, $h_type, $h_desc, $added_by));
        return $this->con->lastInsertId();
    }

    public function add_announcement($a_name, $a_date, $a_desc, $c_id, $added_by)
    {
        $stmt = $this->con->prepare("INSERT INTO announcements (a_title, a_date, a_desc,c_id,added_by) VALUES (?,?,?,?,?)");
        $stmt->execute(array($a_name, $a_date, $a_desc, $c_id, $added_by));
        return $this->con->lastInsertId();
    }

    //Update Profile....
    public function update_profile($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_doj, $u_dob, $u_state, $u_pincode, $u_id)
    {
        $stmt = $this->con->prepare("UPDATE users SET u_name = ?, u_mobile = ?, u_email = ?, u_address = ?, u_district = ?, u_doj = ?, u_dob = ?, u_state = ?, u_pincode = ? WHERE u_id = ?");
        $stmt->execute(array($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_doj, $u_dob, $u_state, $u_pincode, $u_id));
        return true;
    }

    //file insert....
    public function uploadFile($c_id, $u_id, $doc_type, $doc_number, $fileName)
    {
        $stmt = $this->con->prepare("INSERT INTO documents (c_id, u_id, doc_type, doc_number, doc_file) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($c_id, $u_id, $doc_type, $doc_number, $fileName));
        return $this->con->lastInsertId();
    }
    public function addReview($c_id, $u_id, $rating, $review, $added_by)
    {
        $stmt = $this->con->prepare("INSERT INTO reviews (c_id, u_id, rating, review, added_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($c_id, $u_id, $rating, $review, $added_by));
        return $this->con->lastInsertId();
    }
    public function Updaterequest($id, $r_action)
    {
        $stmt = $this->con->prepare("UPDATE requests SET r_action = ? WHERE id = ?");
        $stmt->execute(array($r_action, $id, ));
        return true;
    }

    public function get_password($u_Id)
    {
        $stmt = $this->con->prepare("SELECT u_password FROM users WHERE u_id = ?");
        $stmt->execute(array($u_Id));
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function update_password($u_id, $u_password)
    {
        $stmt = $this->con->prepare("UPDATE users SET u_password = ? WHERE u_id = ?");
        $stmt->execute(array($u_password, $u_id));
        return true;
    }
    public function update_profile_pic($u_id, $fileName)
    {
        $stmt = $this->con->prepare("UPDATE users SET u_pic = ? WHERE u_id = ?");
        $stmt->execute(array($fileName, $u_id));
        return true;
    }
    //request status update
    public function update_request_status($u_id, $status, $id)
    {
        $stmt = $this->con->prepare("UPDATE requests SET r_action = ? WHERE u_id = ? AND id = ?");
        if ($stmt->execute(array($status, $u_id, $id))) {
            return true;
        } else {
            return false;
        }
    }
    //add project 
    public function add_project($p_name, $ps_name, $s_date, $e_date, $p_desc, $c_id, $added_by, $fileName)
    {
        $stmt = $this->con->prepare("INSERT INTO projects (c_id, name, abb_name, s_date, e_date, remark,image, added_by) VALUES (?, ?, ?, ?, ?, ?,?, ?)");
        $stmt->execute(array($c_id, $p_name, $ps_name, $s_date, $e_date, $p_desc, $fileName, $added_by));
        return $this->con->lastInsertId();
    }
    //assign project
    public function assign_project($u_id, $p_id)
    {
        $stmt = $this->con->prepare("INSERT INTO project_assigned (p_id, u_id) VALUES (?, ?)");
        $stmt->execute(array($p_id, $u_id));
        return $this->con->lastInsertId();
    }

    public function update_attendance($u_id, $date, $time, $cid, $loged_by)
    {
        $stmt = $this->con->prepare("INSERT INTO attendances (c_id, u_id, checkin_date, checkin_time,logged_by) VALUES (?, ?, ?, ?,?)");
        $stmt->execute(array($cid, $u_id, $date, $time, $loged_by));
        return $this->con->lastInsertId();
    }

    //function for checkin
    function attendance_log($att_id, $log_type, $log_address, $log_lat_long)
    {

        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO attedance_logs(att_id,log_type,log_time,log_location,log_lat_long) VALUES(?,?,?,?,?)");
        $stmt->execute(array($att_id, $log_type, $date, $log_address, $log_lat_long));
    }

    public function check_attendance($u_id, $date)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id = ? AND DATE(checkin_date) = ?");
        $stmt->execute(array($u_id, $date));
        $result = $stmt->fetch(); // Fetch the first row

        // If a row is fetched, attendance exists; otherwise, it doesn't
        return ($result !== false);
    }

    public function addSalary($c_id, $u_id, $s_year, $s_month, $s_amount)
    {
        $stmt = $this->con->prepare("INSERT INTO salaries (c_id, u_id, s_year, s_month, s_amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($c_id, $u_id, $s_year, $s_month, $s_amount));
        return $this->con->lastInsertId();
    }

    function add_request($c_id, $u_id, $r_type, $r_date, $r_title, $r_desc, $added_by)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO requests(c_id,u_id,r_date,r_title,r_desc,r_type,r_action,added_by,created_at) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($c_id, $u_id, $r_date, $r_title, $r_desc, $r_type, 'Pending', $added_by, $date));
        return $this->con->lastInsertId();
    }

    function update_attendance_time($a_id, $checkin_time)
    {
        $stmt = $this->con->prepare("UPDATE attendances SET checkin_time = ? WHERE id = ?");
        $stmt->execute(array($checkin_time, $a_id));
        return true;
    }

}








?>
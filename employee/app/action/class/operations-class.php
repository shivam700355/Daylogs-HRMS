<?php include_once 'db-connect.php'; ?>
<?php
class Operations extends Database
{
    //function for activity log
    function create_activity($type, $messsage, $added_by)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO activity(type,message,added_by,device,created_at) VALUES(?,?,?,?,?)");
        $stmt->execute(array($type, $messsage, $added_by, 'Browser', $date));
    }

    //function for logout
    function logout($u_id, $session)
    {
        $stmt = $this->con->prepare("DELETE FROM sessions WHERE u_id=:u_id AND session=:session");
        $stmt->execute(array(':u_id' => $u_id, ':session' => $session));
        return true;
    }

    //function for deleting login sessions
    function delete_session($s_id)
    {
        $stmt = $this->con->prepare("DELETE FROM sessions WHERE id=:id");
        $stmt->execute(array(':id' => $s_id));
        return true;
    }



    //function for checkin check
    function check_checkin($c_id, $u_id, $c_date)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE c_id=:c_id AND u_id=:u_id AND checkin_date=:checkin_date AND status = :status");
        $stmt->execute(array(':c_id' => $c_id, ':u_id' => $u_id, ':checkin_date' => $c_date, ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }

    //function for checkin
    function checkin($c_id, $u_id, $c_date, $c_time)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO attendances(c_id,u_id,checkin_date,checkin_time,created_at) VALUES(?,?,?,?,?)");
        $stmt->execute(array($c_id, $u_id, $c_date, $c_time, $date));
        return $this->con->lastInsertId();
    }

    //function for checkin
    function checkout($u_id, $c_date, $c_time, $h_index, $att_id)
    {

        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("UPDATE attendances SET checkout_time=:checkout_time,h_index=:h_index WHERE u_id=:u_id AND checkin_date=:checkin_date");
        $stmt->execute(array(':u_id' => $u_id, ':checkin_date' => $c_date, ':checkout_time' => $c_time, ':h_index' => $h_index));
        return $stmt;
    }


    //function for checkin
    function attendance_log($att_id, $log_type, $log_address, $log_lat_long)
    {

        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO attedance_logs(att_id,log_type,log_time,log_location,log_lat_long) VALUES(?,?,?,?,?)");
        $stmt->execute(array($att_id, $log_type, $date, $log_address, $log_lat_long));
    }



    //function for breakin
    function break_in($u_id, $c_date, $c_time)
    {
        $stmt = $this->con->prepare("UPDATE attendances SET break=:break WHERE u_id=:u_id AND checkin_date=:checkin_date");
        $stmt->execute(array(':u_id' => $u_id, ':checkin_date' => $c_date, ':break' => 1));

        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO break(u_id,a_date,break_in,created_at) VALUES(?,?,?,?)");
        $stmt->execute(array($u_id, $c_date, $c_time, $date));

        return $stmt;
    }

    //function for breakin
    function break_out($u_id, $c_date, $c_time)
    {
        $stmt = $this->con->prepare("UPDATE attendances SET break=:break WHERE u_id=:u_id AND checkin_date=:checkin_date");
        $stmt->execute(array(':u_id' => $u_id, ':checkin_date' => $c_date, ':break' => 0));

        $stmt = $this->con->prepare("UPDATE break SET break_out = :break_out WHERE u_id = :u_id AND a_date = :a_date AND id = (SELECT MAX(id) FROM break WHERE u_id = :u_id AND a_date = :a_date)");
        $stmt->execute(array(':u_id' => $u_id, ':a_date' => $c_date, ':break_out' => $c_time));

        return $stmt;
    }

    //function for breakin
    function get_today_break($u_id)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d");

        $stmt = $this->con->prepare("SELECT u_id, a_date, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_out, break_in)))) AS total_break_time FROM break WHERE u_id = :u_id AND a_date = :a_date GROUP BY u_id, a_date;");
        $stmt->execute(array(':u_id' => $u_id, ':a_date' => $date));
        return $stmt->fetchColumn(PDO::FETCH_ASSOC);
    }
    //Add review 
    public function add_review_and_rating($c_id, $u_id, $rating, $review, $added_by)
    {
        $stmt = $this->con->prepare("INSERT INTO reviews (c_id, u_id, rating, review, added_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($c_id, $u_id, $rating, $review, $added_by));
        return $this->con->lastInsertId();
    }

    //function for creating login sessions
    function add_request($c_id, $u_id, $r_type, $r_date, $r_title, $r_desc)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO requests(c_id,u_id,r_date,r_title,r_desc,r_type,added_by,created_at) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->execute(array($c_id, $u_id, $r_date, $r_title, $r_desc, $r_type,$u_id, $date));
        return $this->con->lastInsertId();
    }

    //function to upload documents....
    public function add_document($c_id, $u_id, $doc_type, $doc_number, $fileName)
    {

        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");

        $stmt = $this->con->prepare("INSERT INTO documents (c_id, u_id, doc_type, doc_number, doc_file,created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($c_id, $u_id, $doc_type, $doc_number, $fileName,$date));
        return $this->con->lastInsertId();
    }
    //Update Profile....
    public function update_profile($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_state, $u_pincode, $u_id)
    {
        $stmt = $this->con->prepare("UPDATE users SET u_name = ?, u_mobile = ?, u_email = ?, u_address = ?, u_district = ?, u_state = ?, u_pincode = ? WHERE u_id = ?");
        $stmt->execute(array($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_state, $u_pincode, $u_id));
        return true;
    }

    //password check
    public function get_password($u_Id)
    {
        $stmt = $this->con->prepare("SELECT u_password FROM users WHERE u_id = ?");
        $stmt->execute(array($u_Id));
        $row = $stmt->fetchColumn();
        return $row;
    }
    //Update Password....
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
    //insert Session.
    public function insert_session($u_id, $device, $platform)
    {
        $session = "pppvvva"; // Assuming this is the session value you want to insert
        $stmt = $this->con->prepare("INSERT INTO sessions (u_id, device,session, platform) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($u_id, $device, $session, $platform));
        return true;
    }

    //function for add work report
    public function add_work_report($c_id, $u_id, $w_date, $w_desc)
    {
        date_default_timezone_set('Asia/Calcutta');
        $date = date("Y-m-d H:i:s");


        $stmt = $this->con->prepare("INSERT INTO works (c_id ,u_id, w_date, w_desc,created_at) VALUES (?,?, ?, ?,?)");
        $stmt->execute(array($c_id, $u_id, $w_date, $w_desc,$date));
        return $this->con->lastInsertId();
    }

    //function for add project report
    public function add_project_report($p_id, $p_date, $remark, $added_by)
    {
        $stmt = $this->con->prepare("INSERT INTO project_progress (p_id, p_date, remark,added_by) VALUES (?, ?, ?, ?)");
        $stmt->execute([$p_id, $p_date, $remark, $added_by]);
        return $this->con->lastInsertId();
    }


    //function for update status
    public function updateStatus($cid, $u_id, $s_msg, $date, $time)
    {
        $stmt = $this->con->prepare("INSERT INTO  status (c_id, u_id, s_msg, s_date, s_time) VALUES (?,?, ?,?, ?)");
        $stmt->execute([$cid, $u_id, $s_msg, $date, $time]);
        return $this->con->lastInsertId();
    }
}
?>
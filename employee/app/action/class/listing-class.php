<?php include_once 'db-connect.php'; ?>
<?php
class Listing extends Database
{
    //function for getting employee list
    public function employee_list($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_role = :u_role AND u_status=:u_status ORDER BY u_name ASC");
        $stmt->execute(array(':u_cid' => $c_id, ':u_role' => "Employee", ':u_status' => 1));
        return $stmt;
    }

    //function for getting employee avg rating
    public function employee_rating($u_id)
    {
        $stmt = $this->con->prepare("SELECT AVG(rating) AS rating FROM reviews WHERE u_id = :u_id AND status = :status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => "1"));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() with FETCH_ASSOC to fetch the associative array
    }

    //function for getting user profile
    public function user_profile($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_id=:u_id");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //function for getting company profile
    public function company_profile($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM clients WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        return $stmt;
    }

    //function for getting activity
    public function user_activity($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM activity WHERE added_by=:added_by ORDER BY id DESC");
        $stmt->execute(array(':added_by' => $id));
        return $stmt;
    }

    //function for getting session
    public function user_session($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM sessions WHERE u_id=:u_id ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //function for getting documents
    public function user_document($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM documents WHERE u_id=:u_id AND status=:status ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $id, ':status' => 1));
        return $stmt;
    }

    //function for getting review
    public function user_review($id)
    {
        $stmt = $this->con->prepare("SELECT reviews.*,users.u_name FROM reviews LEFT JOIN users ON reviews.added_by=users.u_id WHERE reviews.u_id=:u_id AND reviews.status=:status ORDER BY reviews.id DESC");
        $stmt->execute(array(':u_id' => $id, ':status' => 1));
        return $stmt;
    }

    //function for getting request
    public function user_request($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM requests WHERE u_id=:u_id  AND status=:status ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $id, ':status' => 1));
        return $stmt;
    }

    //function for getting current month attendance
    public function user_current_month_attendance($id, $currentMonth, $currentYear)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id=:u_id AND MONTH(checkin_date) = :currentMonth AND YEAR(checkin_date) = :currentYear AND status=:status ORDER BY checkin_date DESC");
        $stmt->execute(array(':u_id' => $id, ':currentMonth' => $currentMonth, ':currentYear' => $currentYear, ':status' => 1));
        return $stmt;
    }

    //function for getting attendance fillter
    public function user_attendance_filter($id, $start_date, $end_date)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id=:u_id AND DATE(checkin_date) BETWEEN :start_date AND :end_date AND status=:status ORDER BY checkin_date ASC");
        $stmt->execute(array(':u_id' => $id, ':start_date' => $start_date, ':end_date' => $end_date, ':status' => 1));
        return $stmt;
    }

    //function for getting holiday
    public function holiday($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM holidays WHERE c_id=:c_id  AND status=:status ORDER BY h_date ASC");
        $stmt->execute(array(':c_id' => $c_id, ':status' => 1));
        return $stmt;
    }

    //function for getting announcement
    public function announcement($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM announcements WHERE c_id=:c_id  AND status=:status ORDER BY a_date DESC");
        $stmt->execute(array(':c_id' => $c_id, ':status' => 1));
        return $stmt;
    }

    //Get employee event(birthday/anniversory)
    public function events($c_id, $current_month)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_status = :u_status AND (MONTH(u_dob) = :current_month OR MONTH(u_doj) = :current_month) AND u_role = :u_role");
        $stmt->execute(array(':u_cid' => $c_id, ':current_month' => $current_month, ':u_status' => 1, ':u_role' => 'Employee'));
        return $stmt;
    }

    //function for getting current day attendance
    public function get_today_attendance($u_id, $date)
    {
        // date_default_timezone_set('Asia/Calcutta');
        // $date = date("Y-m-d");

        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id=:u_id AND checkin_date=:checkin_date AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':checkin_date' => $date, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //function for getting total break time of a day
    public function get_day_total_break($u_id, $date)
    {
        $stmt = $this->con->prepare("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_out, break_in)))) AS total_break_time FROM break WHERE u_id = :u_id AND a_date =:a_date AND break_out!=:break_out AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':a_date' => $date, ':break_out' => '00:00:00', ':status' => 1));
        return $stmt->fetchColumn();
    }


    //function for getting today break time
    public function get_today_break_time($u_id, $date)
    {
        $stmt = $this->con->prepare("SELECT * FROM break WHERE u_id = :u_id AND a_date =:a_date AND break_out='00:00:00'");
        $stmt->execute(array(':u_id' => $u_id, ':a_date' => $date));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //function for getting work report
    public function Work_report($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM works WHERE u_id=:u_id AND status=:status ORDER BY w_date DESC");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt;
    }


    //function for getting projects
    public function project($u_id)
    {
        $stmt = $this->con->prepare("SELECT project_assigned.*,projects.* FROM project_assigned LEFT JOIN projects ON project_assigned.p_id=projects.id WHERE project_assigned.u_id=:u_id AND project_assigned.status=:status ORDER BY projects.name ASC");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt;
    }


    //function for getting projects
    public function project_report($p_id)
    {
        $stmt = $this->con->prepare("SELECT project_progress.*, users.u_name FROM project_progress LEFT JOIN users ON project_progress.added_by = users.u_id  WHERE project_progress.p_id = :p_id AND project_progress.status = :status ORDER BY project_progress.p_date DESC");
        $stmt->execute(array(':p_id' => $p_id, ':status' => 1));
        return $stmt;
    }

    //function for getting projects
    public function project_details($p_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM projects WHERE id=:id AND status=:status");
        $stmt->execute(array(':id' => $p_id, ':status' => 1));
        return $stmt;
    }
    //function for Get Status
    public function get_status($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM `status` WHERE u_id = :u_id AND id = (SELECT MAX(id) FROM `status` WHERE u_id = :u_id)");
        $stmt->execute(array(':u_id' => $u_id));
        return $stmt;
    }

    //public status
    public function status($u_id)
    {
        $stmt = $this->con->prepare("SELECT users.u_id, users.u_name, status.s_msg, status.s_date, status.s_time FROM users JOIN status ON users.u_id = status.u_id WHERE users.u_id =:u_id ORDER BY status.id DESC");
        $stmt->execute(array(':u_id' => $u_id));
        return $stmt;
    }

}
?>
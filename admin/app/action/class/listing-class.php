<?php include_once 'db-connect.php'; ?>
<?php
class Listing extends Database
{

    //Get District list....
    public function district_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE status = :status ORDER BY district ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }
    //Get State list....
    public function state_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE status = :status  GROUP BY state ORDER BY state ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }

    //Get District list....
    public function state_district_list($state)
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE state = :state AND state=:state ORDER BY district ASC");
        $stmt->execute(array(':state' => $state, ':status' => 1));
        return $stmt;
    }
    //Get Role list....
    public function role_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM role WHERE status=:status ORDER BY name ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }

    //Get user list....
    public function user_list($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_role!=:u_role ORDER BY u_name ASC");
        $stmt->execute(array(':u_cid' => $c_id, ':u_role' => 'Admin'));
        return $stmt;
    }

    //Get user list....
    public function active_user_list($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_role=:u_role AND  u_status=:u_status ORDER BY u_name ASC");
        $stmt->execute(array(':u_cid' => $c_id, ':u_role' => 'Employee', ':u_status' => 1));
        return $stmt;
    }

    //Get user list....
    public function inactive_user_list($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_role=:u_role AND u_status=:u_status ORDER BY u_name ASC");
        $stmt->execute(array(':u_cid' => $c_id, ':u_role' => 'Employee', ':u_status' => 0));
        return $stmt;
    }

    public function get_unassigned_project_employee($c_id, $p_id)
    {
        $stmt = $this->con->prepare("
            SELECT *
            FROM users
            WHERE u_cid = :u_cid 
            AND u_role = 'Employee' 
            AND u_status = '1' 
            AND NOT EXISTS (
                SELECT 1 
                FROM project_assigned 
                WHERE p_id = :p_id 
                AND u_id = users.u_id
            ) 
            ORDER BY u_name ASC
        ");

        $stmt->execute(array(':u_cid' => $c_id, ':p_id' => $p_id));

        return $stmt;
    }


    //Get user profile....
    public function user_profile($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_id=:u_id");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //Get user activity....
    public function user_activity($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM activity WHERE added_by=:added_by ORDER BY id DESC");
        $stmt->execute(array(':added_by' => $id));
        return $stmt;
    }

    //Get user documents....
    public function user_document($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM documents WHERE u_id=:u_id ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //Get user attendance....
    public function user_attendance($id)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id=:u_id ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //Get user holidays....
    public function holiday($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM holidays WHERE c_id=:c_id ORDER BY h_date ASC");
        $stmt->execute(array(':c_id' => $c_id));
        return $stmt;
    }

    //Get user projects....
    public function project($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM projects WHERE c_id=:c_id ORDER BY name ASC");
        $stmt->execute(array(':c_id' => $c_id));
        return $stmt;
    }


    //Get user review....
    public function review($u_id)
    {
        $stmt = $this->con->prepare("SELECT SUM(rating) as rating, COUNT(id) as count FROM reviews WHERE u_id=:u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get user document....
    public function document($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM documents WHERE u_id=:u_id AND status=:status ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get user attendance....
    public function current_month_attendance($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE u_id=:u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //Get user happiness index list....
    public function happiness_indexes($u_id)
    {
        $stmt = $this->con->prepare("SELECT h_index, COUNT(*) AS count FROM attendances WHERE u_id = :u_id AND status = :status AND h_index>0 GROUP BY h_index");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all happiness indexes and counts
    }

    //Get training appliaction report....
    public function get_current_month_attendance_count($cid, $first_day_of_month, $last_day_of_month)
    {
        // Prepare the SQL query with placeholders for parameters
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE checkin_date >= :first_day_of_month AND checkin_date <= :last_day_of_month AND c_id = :cid AND status=:status");
        $stmt->execute(array(':cid' => $cid, ':first_day_of_month' => $first_day_of_month, ':last_day_of_month' => $last_day_of_month, ':status' => 1));
        $stmt->execute();
        return $stmt;
    }

    //Get employee event(birthday/anniversory)
    public function events($c_id, $current_month)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_status = :u_status AND (MONTH(u_dob) = :current_month OR MONTH(u_doj) = :current_month) AND u_role = :u_role");
        $stmt->execute(array(':u_cid' => $c_id, ':current_month' => $current_month, ':u_status' => 1, ':u_role' => 'Employee'));
        return $stmt;
    }

    //Get announcement....
    public function announcement($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM announcements WHERE c_id=:c_id  AND status=:status LIMIT 5");
        $stmt->execute(array(':c_id' => $c_id, ':status' => 1));
        return $stmt;
    }

    //Get request
    public function request($c_id)
    {
        $stmt = $this->con->prepare("SELECT requests.* , users.u_name, users.u_mobile  FROM requests left join users on requests.u_id=users.u_id  WHERE requests.c_id=:c_id  AND requests.status=:status ORDER BY r_date DESC");
        $stmt->execute(array(':c_id' => $c_id, ':status' => 1));
        return $stmt;
    }


    public function Get_Start_End_date($id, $startDate, $endDate)
    {
        $stmt = $this->con->prepare("SELECT * FROM attendances INNER JOIN users ON attendances.u_id=users.u_id WHERE c_id=:c_id AND DATE(checkin_date) BETWEEN :startDate AND :endDate AND status=:status ORDER BY id DESC");
        $stmt->execute(array(':c_id' => $id, ':startDate' => $startDate, ':endDate' => $endDate, ':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function employee_session($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM sessions WHERE c_id=:c_id ORDER BY id DESC");
        $stmt->execute(array(':c_id' => $c_id));
        return $stmt;
    }
    public function get_work_report()
    {
        $stmt = $this->con->prepare("SELECT * FROM works INNER JOIN users ON works.u_id=users.u_id WHERE status = :status");
        $stmt->execute(array(':status' => 1));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function project_report($p_id)
    {
        $stmt = $this->con->prepare("SELECT project_progress.*, users.u_name FROM project_progress LEFT JOIN users ON project_progress.added_by = users.u_id  WHERE project_progress.p_id = :p_id AND project_progress.status = :status ORDER BY project_progress.p_date DESC");
        $stmt->execute(array(':p_id' => $p_id, ':status' => 1));
        return $stmt;
    }
    // project detial
    public function project_details($p_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM projects WHERE id=:id AND status=:status");
        $stmt->execute(array(':id' => $p_id, ':status' => 1));
        return $stmt;
    }

    //function for getting current month attendance
    public function current_month_attendance_all($id, $currentMonth, $currentYear)
    {
        $stmt = $this->con->prepare("SELECT attendances.*, users.u_name 
        FROM attendances 
        LEFT JOIN users ON attendances.u_id = users.u_id 
        WHERE attendances.c_id = :c_id 
            AND MONTH(attendances.checkin_date) = :currentMonth 
            AND YEAR(attendances.checkin_date) = :currentYear 
            AND attendances.status = :status 
        ORDER BY attendances.checkin_date DESC, users.u_name ASC
        ");
        $stmt->execute(array(':c_id' => $id, ':currentMonth' => $currentMonth, ':currentYear' => $currentYear, ':status' => 1));
        return $stmt;
    }

    //function for getting attendance fillter
    public function attendance_filter_all($id, $start_date, $end_date)
    {
        $stmt = $this->con->prepare("SELECT attendances.*, users.u_name 
        FROM attendances 
        LEFT JOIN users ON attendances.u_id = users.u_id 
        WHERE attendances.c_id = :c_id 
            AND DATE(attendances.checkin_date) BETWEEN :start_date AND :end_date 
            AND attendances.status = :status 
            ORDER BY attendances.checkin_date DESC, users.u_name ASC
        ");
        $stmt->execute(array(':c_id' => $id, ':start_date' => $start_date, ':end_date' => $end_date, ':status' => 1));
        return $stmt;
    }

    //function for getting total break time of a day
    public function get_day_total_break($u_id, $date)
    {
        $stmt = $this->con->prepare("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(break_out, break_in)))) AS total_break_time FROM break WHERE u_id = :u_id AND a_date =:a_date AND break_out!=:break_out AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':a_date' => $date, ':break_out' => '00:00:00', ':status' => 1));
        return $stmt->fetchColumn();
    }

    //function for getting work status
    public function get_status($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM status WHERE id = (SELECT MAX(id) FROM status WHERE u_id=:u_id AND status=:status)");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array

    }

    //function for getting work status
    public function get_all_status($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM status WHERE u_id = :u_id AND status = 1 ORDER BY s_date DESC");
        $stmt->execute(array(':u_id' => $u_id));
        return $stmt; // Return the PDOStatement object
    }

    //
    public function active_employee_list($c_id, $start_date, $end_date)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_cid = :u_cid AND u_role=:u_role AND  u_status=:u_status ORDER BY u_name ASC");
        $stmt->execute(array(':u_cid' => $c_id, ':u_role' => 'Employee', ':u_status' => 1));
        return $stmt;
    }

    public function get_checkin_count_between_date($u_id, $start_date, $end_date)
    {
        // Prepare the SQL query with placeholders for parameters
        $stmt = $this->con->prepare("SELECT * FROM attendances WHERE checkin_date >= :start_date AND checkin_date <= :end_date AND u_id = :u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':start_date' => $start_date, ':end_date' => $end_date, ':status' => 1));
        $row_count = $stmt->rowCount();

        // Return the number of rows
        return $row_count;

    }

    //salary list
    public function salary_list($u_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM salaries WHERE u_id=:u_id AND status=:status ORDER BY id DESC");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt;
    }


}
?>
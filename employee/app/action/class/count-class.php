<?php include_once 'db-connect.php'; ?>
<?php
class Count extends Database
{

    //Get Total client count....
    public function working_days_count($u_id)
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $stmt = $this->con->prepare("SELECT COUNT(id) FROM attendances WHERE u_id=:u_id AND status=:status AND DATE_FORMAT(checkin_date, '%Y-%m') = :currentMonth");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1, ':currentMonth' => "$currentYear-$currentMonth"));
        $row = $stmt->fetchColumn();
        return $row;
    }



    //Get employee happiness index list....
    public function happiness_indexes($u_id)
    {
        $stmt = $this->con->prepare("SELECT u_id,COUNT(id) AS count, SUM(h_index) AS h_index FROM attendances WHERE u_id = :u_id AND status = :status AND h_index >0 GROUP BY u_id");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all happiness indexes and counts
    }

    //Get employee rating list....
    public function rating($u_id)
    {
        $stmt = $this->con->prepare("SELECT AVG(rating) AS rating FROM reviews WHERE u_id = :u_id AND status = :status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all happiness indexes and counts
    }

    //Get employee  count....
    public function user_session($u_id, $session)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM sessions WHERE u_id=:u_id AND session=:session");
        $stmt->execute(array(':u_id' => $u_id, ':session' => $session));
        $row = $stmt->fetchColumn();
        return $row;
    }

    //Get Total client count....
    public function project_count($u_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM project_assigned WHERE  u_id=:u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }

    public function project_member_count($p_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM project_assigned WHERE  p_id=:p_id AND status=:status");
        $stmt->execute(array(':p_id' => $p_id, ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }















    //get count of total working days (####Do not edit)
    public function total_working_days_count($u_id)
    {

        $stmt = $this->con->prepare("SELECT COUNT(id) FROM attendances WHERE u_id=:u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }

    //get count of total working days (####Do not edit)
    public function total_not_checkout_count($u_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM attendances WHERE u_id=:u_id AND checkout_time=:checkout_time AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':checkout_time' => '00:00:00', ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }

    //get count of total work count (###Do not edit)
    public function total_work_count($u_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(DISTINCT w_date) FROM works WHERE u_id=:u_id AND status=:status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }


    //get count of total work count  (####Do not edit)
    public function total_rating_sum($u_id)
    {
        $stmt = $this->con->prepare("SELECT SUM(rating) AS rating_sum FROM reviews WHERE u_id = :u_id AND status = :status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all happiness indexes and counts
    }


    // function for getting rating count (####Do not edit)
    public function total_rating_count($u_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) AS rating_count FROM reviews WHERE u_id = :u_id AND status = :status");
        $stmt->execute(array(':u_id' => $u_id, ':status' => 1));
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch all happiness indexes and counts
    }



    public function avg_user_rating($u_id)
    {
        $total_working_day = $this->total_working_days_count($u_id);
        $total_not_checkout = $this->total_not_checkout_count($u_id);
        $total_work = $this->total_work_count($u_id);
        //$rating = $this->total_rating_count($u_id);
        $total_rating = $this->total_rating_count($u_id)['rating_count'];
        $rating_sum = $this->total_rating_sum($u_id)['rating_sum'];
    
        $checkout_percentage = ($total_working_day > 0) ? number_format(($total_not_checkout / $total_working_day) * 100, 2) : 0;
        $work_percentage = ($total_working_day > 0) ? number_format(($total_work / $total_working_day) * 100, 2) : 0;
        $avg_checkout = number_format(($checkout_percentage * 5) / 100, 2);
        $avg_work = number_format(($work_percentage * 5) / 100, 2);
        $avg_rating = ($total_rating > 0) ? number_format(($rating_sum / $total_rating), 2) : 0;
    
        $total_percentage = number_format(($checkout_percentage + $work_percentage + 100), 2);
        $total_avg_rating = number_format(($avg_checkout + $avg_work + $avg_rating) / 3, 2);
    
        return [
            'total_working_day' => $total_working_day,
            'total_not_checkout_day' => $total_not_checkout,
            'total_work_report' => $total_work,
            'total_rating' => $rating_sum.'/'.$total_rating,
            'checkout_percentage' => $checkout_percentage,
            'work_percentage' => $work_percentage,
            'rating_percentage' => '100.00',
            'checkout_avg' => $avg_checkout,
            'work_avg' => $avg_work,
            'rating_avg' => $avg_rating,
            'total_percentage' => $total_percentage,
            'total_avg_rating' => $total_avg_rating
        ];
    }
    
    
}
?>
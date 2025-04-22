<?php include_once 'db-connect.php'; ?>
<?php
class Count extends Database
{

    //Get Total client count....
    public function client_count()
    {
        $stmt = $this->con->prepare("SELECT COUNT(id) FROM clients WHERE status=:status");
        $stmt->execute(array(':status' => 1));
        $row = $stmt->fetchColumn();
        return $row;
    }

    //Get Paid Amount sum  count....
    public function user_count()
    {
        $stmt = $this->con->prepare("SELECT COUNT(u_id) FROM users WHERE u_status=:u_status AND u_role!=:u_role");
        $stmt->execute(array(':u_status' => 1,':u_role' => 'Super Admin'));
        $row = $stmt->fetchColumn();
        return $row;
    }


}
?>
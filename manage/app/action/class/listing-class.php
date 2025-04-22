<?php include_once 'db-connect.php'; ?>
<?php
class Listing extends Database
{

    //Get district list....
    public function district_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE status = :status ORDER BY district ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }
    //Get state list....
    public function state_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE status = :status  GROUP BY state ORDER BY state ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }

    //Get state district list....
    public function state_district_list($state)
    {
        $stmt = $this->con->prepare("SELECT * FROM districts WHERE state = :state AND state=:state ORDER BY district ASC");
        $stmt->execute(array(':state' => $state, ':status' => 1));
        return $stmt;
    }
    //Get role list....
    public function role_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM role WHERE status=:status ORDER BY name ASC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }


    //Get client list....
    public function client_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM clients ORDER BY name ASC");
        $stmt->execute();
        return $stmt;
    }

    //Get admin list....
    public function admin_list()
    {
        $stmt = $this->con->prepare("SELECT users.*,clients.* FROM users LEFT JOIN clients ON users.u_cid=clients.id WHERE users.u_role = :u_role ORDER BY users.u_id DESC");
        $stmt->execute(array(':u_role' => "Admin"));
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
        $stmt = $this->con->prepare("SELECT * FROM activity WHERE u_id=:u_id ORDER BY u_id DESC");
        $stmt->execute(array(':u_id' => $id));
        return $stmt;
    }

    //Get contact list....
    public function contact_list()
    {
        $stmt = $this->con->prepare("SELECT * FROM contacts WHERE status=:status ORDER BY created_at DESC");
        $stmt->execute(array(':status' => 1));
        return $stmt;
    }
}
?>
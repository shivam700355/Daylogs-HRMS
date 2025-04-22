<?php include_once 'db-connect.php'; ?>
<?php
class Front extends Database
{
    //Front page contact information insert
    public function contact_insert($name, $mobile, $email, $subject, $message)
    {
        try {
            $stmt = $this->con->prepare("INSERT INTO contacts (name, mobile, email, subject, message) VALUES(:c_name, :c_mobile, :c_email, :c_subject, :c_message)");
            $stmt->execute(array(':c_name' => $name, ':c_mobile' => $mobile, ':c_email' => $email, ':c_subject' => $subject, ':c_message' => $message));
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    //Front page client listing 
    public function client_listing()
    {
        $stmt = $this->con->prepare("SELECT * FROM clients WHERE status = 1 ORDER BY id ASC");
        $stmt->execute();
        return $stmt;
    }






}
?>
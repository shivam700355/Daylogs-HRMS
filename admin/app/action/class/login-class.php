<?php
include_once 'db-connect.php';
class Login extends Database
{

    public function vaildate_login($email, $password, $bos, $ip, $port, $city, $country)
    {
        $stmt = $this->con->prepare("SELECT * FROM users WHERE u_email = :u_email OR u_mobile = :u_mobile LIMIT 1");
        $stmt->execute(array(':u_email' => $email, ':u_mobile' => $email));

        if ($stmt->rowCount() != 0) {
            $row = $stmt->fetch();

            if (password_verify($password, $row['u_password']) and $row['u_status'] == 1) {
                $status = 1;

                $stmt_log = $this->con->prepare("INSERT INTO login_log (l_email, l_remote_ip, l_bos, l_port, l_city, l_country, l_status) VALUES (?,?,?,?,?,?,?)");
                $stmt_log->execute(array($email, $ip, $bos, $port, $city, $country, $status));
                return $row;
            } else {

                $status = 0;

                $stmt_log = $this->con->prepare("INSERT INTO login_log (l_email, l_remote_ip, l_bos, l_port, l_city, l_country, l_status) VALUES (?,?,?,?,?,?,?)");
                $stmt_log->execute(array($email, $ip, $bos, $port, $city, $country, $status));

                return null;
            }
        } else {

            $status = 0;

            $stmt_log = $this->con->prepare("INSERT INTO login_log (l_email, l_remote_ip, l_bos, l_port, l_city, l_country, l_status) VALUES (?,?,?,?,?,?,?)");
            $stmt_log->execute(array($email, $ip, $bos, $port, $city, $country, $status));

            return null;
        }
    }

    public function client_profile($c_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM clients WHERE id = :id");
        $stmt->execute(array(':id' => $c_id));
        $row = $stmt->fetch();
        return $row;
    }
}

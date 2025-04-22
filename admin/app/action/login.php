<?php include "../app_include/session.php"; ?>
<?php include 'class/login-class.php'; ?>
<?php include 'class/operations-class.php'; ?>
<?php
if (isset($_POST['username']) and isset($_POST['password']) and $_POST['token'] == $_SESSION['token']) {

    $email = $_POST['username'];
    $password = $_POST['password'];

    $bos = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $port = $_SERVER['SERVER_PORT'];

    $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

    if (!empty($geo['geoplugin_city'])) {
        $city = $geo['geoplugin_city'];
    } else
        $city = "NA";
    if (!empty($geo['geoplugin_countryName'])) {
        $country = $geo['geoplugin_countryName'];
    } else
        $country = "NA";

    $loging = new Login();
    $row = $loging->vaildate_login($email, $password, $bos, $ip, $port, $city, $country);
    if ($row != null) {


        $_SESSION['daylogs_session'] = md5($row['u_id'] . mt_rand(1000000, 9999999));

        $client = $loging->client_profile($row['u_cid']);

        $op = new Operations();
        $create = $op->create_login_session($row['u_cid'], $row['u_id'], $_SESSION['daylogs_session']);



        $_SESSION['u_id'] = $row['u_id'];
        $_SESSION['name'] = $row['u_name'];
        $_SESSION['email'] = $row['u_email'];
        $_SESSION['role'] = $row['u_role'];
        $_SESSION['cid'] = $row['u_cid'];
        $_SESSION['pic'] = $row['u_pic'];

        $_SESSION['cid'] = $client['id'];
        $_SESSION['cname'] = $client['name'];
        $_SESSION['cabbname'] = $client['abb_name'];
        $_SESSION['cpic'] = $client['image'];

        echo json_encode(
            array(
                "valid" => 1,
                "message" => "Logged in successfully",
                "uname" => $_SESSION['name'],
                "urole" => $_SESSION['role']
            )
        );

        $messsage = "Logged in successfull.id #";
        $type = "Logged " . $_SESSION['name'];
        //$row = $op->create_activity($type, $messsage, $_SESSION['u_id']);



    } else {
        echo json_encode(
            array(
                "valid" => 0,
                "message" => "Authentication failed",
                "uname" => $email
            )
        );
    }
} else {
    echo json_encode(
        array(
            "valid" => 0,
            "message" => "Something went wrong"
        )
    );
}

?>
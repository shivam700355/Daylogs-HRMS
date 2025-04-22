<?php include "../app_include/session.php"; ?>
<?php include 'class/login-class.php'; ?>
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

    $login = new Login();
    $row = $login->vaildate_login($email, $password, $bos, $ip, $port, $city, $country);
    if ($row != null) {


        $_SESSION['vaaf_session_id'] = $row['u_name'] . mt_rand(1000, 10000);

        $client = $login->client_profile($row['u_cid']);


        $_SESSION['u_id'] = $row['u_id'];
        $_SESSION['name'] = $row['u_name'];
        $_SESSION['email'] = $row['u_email'];
        $_SESSION['role'] = $row['u_role'];
        $_SESSION['cid'] = $row['u_cid'];
        $_SESSION['pic'] = $row['u_pic'];

        $_SESSION['cname'] = $client['name'];
        $_SESSION['cabbname'] = $client['abb_name'];
        $_SESSION['cpic'] = $client['image'];

        echo json_encode(
            array(
                "valid" => 1,
                "message" => "Logged in successfully",
                "role" => $_SESSION['role']
            )
        );
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
            "message" => "Something went wrong!"
        )
    );
}

?>
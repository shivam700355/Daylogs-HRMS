<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function is_logged_in()
{
    if (!isset($_SESSION['vaaf_session_id'])) {
        session_destroy();
        echo "<script>window.location = 'login';</script>";
    }

}

function count_digit($number) {
  return strlen($number);
}

function divider($number_of_digits) {
    $tens="1";

  if($number_of_digits>8)
    return 10000000;

  while(($number_of_digits-1)>0)
  {
    $tens.="0";
    $number_of_digits--;
  }
  return $tens;
}


function upload_image($location)
{
    if(isset($_FILES["file"]))
    {
        $extension = explode('.', $_FILES['file']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location . $new_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
        return $new_name;
    }   
}

function upload_aadhar($location)
{
    if(isset($_FILES["file_aadhar"]))
    {
        $extension = explode('.', $_FILES['file_aadhar']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location . $new_name;
        move_uploaded_file($_FILES['file_aadhar']['tmp_name'], $destination);
        return $new_name;
    }   
}



function upload_image_avalamb($locationimg)
{
    if(isset($_FILES["file_applicant"]))
    {
        $extension = explode('.', $_FILES['file_applicant']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $locationimg . $new_name;
        move_uploaded_file($_FILES['file_applicant']['tmp_name'], $destination);
        return $new_name;
    }   
}


function upload_file1($location1)
{
    if(isset($_FILES["file1"]))
    {
        $extension = explode('.', $_FILES['file1']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location1 . $new_name;
        move_uploaded_file($_FILES['file1']['tmp_name'], $destination);
        return $new_name;
    }
}


function upload_file2($location2)
{
    if(isset($_FILES["file2"]))
    {
        $extension = explode('.', $_FILES['file2']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location2 . $new_name;
        move_uploaded_file($_FILES['file2']['tmp_name'], $destination);
        return $new_name;
    }
}


function upload_file3($location3)
{
    if(isset($_FILES["file3"]))
    {
        $extension = explode('.', $_FILES['file3']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location3 . $new_name;
        move_uploaded_file($_FILES['file3']['tmp_name'], $destination);
        return $new_name;
    }
}



/**
 * Return the slug of a string to be used in a URL.
 *
 * @return String
 */
function slugify($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicated - symbols
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) {
      return 'n-a';
    }
    return $text;
}

// $url = slugify('Hello world, this is the name of my article');
// echo $url;

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'techoptims';
    $secret_iv = 'tech@123';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


function invoice_num ($input, $pad_len = 4, $prefix = null) {
    if ($pad_len <= strlen($input))
        trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

    if (is_string($prefix))
        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
}

  /**
   * Converting Currency Numbers to words currency format
   */
  function amount_world($number) {
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $output = ucwords($result . "Rupees  " . $points ." only.");
  echo $output;
}

?>
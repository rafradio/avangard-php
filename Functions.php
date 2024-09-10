<?php
function createURL($url) {
    $path = dirname(__FILE__);
    $rndStr = random_strings(8);
    $fullPath = $path . "/" . $rndStr . ".php";
    $nameOfFile = $rndStr . ".php";
    $myfile = fopen($fullPath, "w") or die("Unable to open file!");
    $txt = "<?php\n";
    $txt .= 'header("Location: ' . $url . '");';
    $txt .= "\n";
    $actual_link = "https://$_SERVER[HTTP_HOST]";
    $actual_link .= "/AvangardPHP/" . $nameOfFile;
    fwrite($myfile, $txt);
    fclose($myfile);
    return $actual_link;
}

function random_strings($length_of_string) {
    $input = fopen("config.txt", "r");
    while(!feof($input)) {
        $dataDB[] = trim(fgets($input));
    }
    $servername = $dataDB[0];
    $username = $dataDB[1];
    $password = $dataDB[2];
    $dbname = $dataDB[3];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset('utf8');
    $UrlArrs = array();
    $q = "SELECT material FROM mydb.materiallinks";
    $result_qaz = $conn->query($q);
    while($row_in = $result_qaz->fetch_assoc()) {
        $UrlArrs[] = $row_in;
    }
   
    $str_first = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $str_result = substr(str_shuffle($str_first), 0, $length_of_string);
    $flag = true;
    while ($flag) {
        if (in_array($str_result, $UrlArrs)) {
            $str_result = substr(str_shuffle($str_first), 0, $length_of_string);
        } else {
            $q = "INSERT INTO mydb.materiallinks (material) VALUES ('" . "$str_result" . "');";
            $result_qaz = $conn->query($q);
            $flag = false;
        }
    }
    return $str_result;
}


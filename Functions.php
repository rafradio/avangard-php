<?php
function createURL($url) {
    
    // Записываем в корневой каталог php файл с перенаправлением
    $path = dirname(__FILE__);
    $rndStr = random_strings(8);
    $fullPath = $path . "/" . $rndStr . ".php";
    $nameOfFile = $rndStr . ".php";
    $myfile = fopen($fullPath, "w") or die("Unable to open file!");
    $txt = "<?php\n";
    $txt .= 'header("Location: ' . $url . '");';
    $txt .= "\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    
    // формируем url данного файла
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') { $link = "https";}
    else {$link = "http";}
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $checkPath = explode('/',$_SERVER['REQUEST_URI']);
    if (count($checkPath)> 2) { $actual_link = $link . "/" . $checkPath[1] . "/" . $nameOfFile;}
    else {$actual_link = $link . "/" . $nameOfFile;}
    
    return $actual_link;
    
}

// формируем уникальную адрес и проверяем отсутсвие его повтора
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
    $q = "SELECT material FROM materiallinks";
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
            $q = "INSERT INTO materiallinks (material) VALUES ('" . "$str_result" . "');";
            $result_qaz = $conn->query($q);
            $flag = false;
        }
    }
    return $str_result;
    
}


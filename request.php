<?php
    include 'Functions.php';
    $bodyFromFront = file_get_contents('php://input');
    $data = json_decode($bodyFromFront);
    $resultUrl = createURL($data->{'data'});
    $out['data'] = $resultUrl;
    echo json_encode($out);

<?php
    include 'Functions.php';
    $bodyFromFront = file_get_contents('php://input');
    $data = json_decode($bodyFromFront);
    
    // здесь формируется url который направляется клиенту
    $resultUrl = createURL($data->{'data'});
    
    $out['data'] = $resultUrl;
    
    echo json_encode($out);

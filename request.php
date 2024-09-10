<?php
    $body2 = file_get_contents('php://input');
    $data = json_decode($body2);
    $out['data'] = "From server";
    echo json_encode($out);

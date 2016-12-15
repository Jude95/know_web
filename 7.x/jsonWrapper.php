<?php
function success_encode($data = null)
{
    $result["status"] = 200;
    $result["info"] = "success";
    if ($data) {
        $result['data'] = $data;
    }
    echo json_encode($result);
    exit(0);
}

function other_encode($status, $info, $data = null)
{
    $result["status"] = $status;
    $result["info"] = $info;
    if ($data) {
        $result['data'] = $data;
    }
    echo json_encode($result);
    exit(0);
}


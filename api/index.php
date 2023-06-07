<?php

function api_response($ep)
{
    if (!file_exists('endpoint/' . $ep . '.php')) {
        return json_encode([
            'status' => 404,
            'message' => 'API tidak ditemukan'
        ]);

    }

    $db = new SQLite3('../db/absenky.db');

    require_once('endpoint/' . $ep . '.php');

    

}

if (isset($_GET['q'])) {
    $ep = $_GET['q'];
    echo api_response($ep);
}
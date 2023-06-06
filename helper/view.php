<?php

function components($v, $data = [])
{
    extract($data);
    include('components/' . $v . '.php');
}
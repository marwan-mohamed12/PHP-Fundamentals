<?php

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    function checkLength($length, $str)
    {
        return strlen($str) < $length;
    }

?>

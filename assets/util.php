<?php

class Util
{
    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);

        return $data;
    }

    public function showMessage($type, $message)
    {
        if ($type == 'success') {
            return  '<h4>' .$message.'</h4>' ;
        } else {
            return '<div class="alert alert-' . $type . ' fade show" role="alert">' . $message . '</div>';
        }
    }
}

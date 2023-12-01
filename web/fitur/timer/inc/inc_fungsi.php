<?php
function url_dasar(){
    $url_dasar  = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}
?>
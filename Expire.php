<?php
if (isset($_COOKIE['profile'])){
    setcookie('profile', $_COOKIE['profile'], time() - 1, '/');
}
if (isset($_COOKIE['job_title'])){
    setcookie('job_title', $_COOKIE['job_title'], time() - 1, '/');
}
if (isset($_COOKIE['Proficient_in'])){
    setcookie('Proficient_in', $_COOKIE['Proficient_in'], time() - 1, '/');
}
if (isset($_COOKIE['additional_details'])){
    setcookie('additional_details', $_COOKIE['additional_details'], time() - 1, '/');
}
if (isset($_COOKIE['college'])){
    setcookie('college', $_COOKIE['college'], time() - 1, '/');
}
if (isset($_COOKIE['college'])){
    setcookie('reload_flag', '1', time() + 3600, '/');
}
?>
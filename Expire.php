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
if (isset($_COOKIE['job_roadmap'])){
    setcookie('job_roadmap', $_COOKIE['job_roadmap'], time() - 1, '/');
}
if (isset($_COOKIE['job_available'])){
    setcookie('job_available', $_COOKIE['job_available'], time() - 1, '/');
}
?>
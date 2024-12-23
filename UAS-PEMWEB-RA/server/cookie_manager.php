<?php
// Menetapkan cookie
function setCookieData($name, $value, $expire)
{
    setcookie($name, $value, time() + $expire, "/");
}

// Mendapatkan cookie
function getCookieData($name)
{
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

// Menghapus cookie
function deleteCookie($name)
{
    setcookie($name, "", time() - 3600, "/");
}
?>

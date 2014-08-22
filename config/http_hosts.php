<?php
function http_host($host)
{
    $http_hosts = array(
        'student' => 'student',
        'firma' => 'cdmanager',
        'admin' => 'cdmanager'
    );
    return $http_hosts[$host];
}

?>

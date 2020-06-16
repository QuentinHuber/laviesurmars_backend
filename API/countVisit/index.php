<?php 
    $ip = fopen('last_ip.txt', 'c+');
    $check = fgets($ip);
    $file = fopen('counter.txt', 'c+');
    $count = intval(fgets($file));

    if($_SERVER['REMOTE_ADDR'] != $check){   
        fclose($ip);
        $ip = fopen('last_ip.txt', 'w+');
        fputs($ip, $_SERVER['REMOTE_ADDR']);
        $count++;
        fseek($file, 0);
        fputs($file, $count);
    }

    fclose($file);
    fclose($ip);
    echo $count;
?>
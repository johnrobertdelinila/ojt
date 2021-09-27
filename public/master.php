<?php

$valuable_file = fopen("valuable.txt", "r") or die("Unable to open file!");
$valuable = fread($valuable_file,filesize("valuable.txt"));
fclose($valuable_file);

$txt = base64_decode($valuable).trim(str_replace('SerialNumber','',shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1')));

$profile_file = fopen("profile.txt", "r") or die("Unable to open file!");
$profile = fread($profile_file,filesize("profile.txt"));
fclose($profile_file);

if(base64_encode($txt) != $profile){
    redirect()->to('activation')->send();
}

?>
<?php
function atftpdr() {
$wlacza = shell_exec('sudo systemctl restart atftpd.socket');
$wlacza2 = shell_exec('sudo systemctl restart atftpd.service');
echo $wlacza;
echo $wlacza2;
}

function sshr(){
$wlaczs2 = shell_exec('sudo systemctl restart ssh.service');
echo $wlaczs2;
}

function wwwr() {
$wlaczw2 = shell_exec('sudo systemctl restart apache2.service');
echo $wlaczw2;
}

//wylaczanie
function atftpdoff() {
    
    $wlacza = shell_exec('sudo systemctl stop atftpd.socket');
    $wlacza2 = shell_exec('sudo systemctl stop atftpd.service');
    echo $wlacza;
    echo $wlacza2;
    }
    
    function sshofff(){
    $wlaczs2 = shell_exec('sudo systemctl stop ssh.service');
    echo $wlaczs2;
    }
    

if(isset($_GET['page']))
{
    $page = $_POST['page'];

    if(!empty($page))
    {
        // $page;
        echo ("Działa");
    }
}




// header('location:status.php')
?>
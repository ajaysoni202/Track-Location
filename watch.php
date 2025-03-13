<?php

$myFile = "IP.txt";
$fh = fopen($myFile, 'a') or die("Can't open file");

// Get the IP address
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR']; // Get the forwarded IP address if available
} else {
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Fall back to the remote address
}

$stringData = "\n"."IP: " . $ipAddress . "    " ."USER_AGENT: ".$_SERVER['HTTP_USER_AGENT'] . "    "."DATE: ".date("D dS M,Y h:i a")."\n";
fwrite($fh, $stringData);
fclose($fh);

if (isset($_GET['v'])) {
    $page = 'https://www.youtube.com/watch?v=' . $_GET['v'];
    header('Location: ' . $page);
    echo <<<DATA
    <head>
    <meta http-equiv="refresh" content="0;url={$page}">
    <script type="text/javascript">
    window.location="{$page}";
    </script>
    </head>
DATA;
}

?>

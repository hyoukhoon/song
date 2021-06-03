<?php

$command = escapeshellcmd('/home/hyoukhoon/daumStock.py');
$output = shell_exec($command);
echo "result=>".$output;

$output = shell_exec('python3 -V');
echo "<pre>$output</pre>";
?>
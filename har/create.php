<?php

$file = file_get_contents('code.infitialis.com.har');

$json = json_decode($file, true);

//print_r($json);
$i = 0;
$b = 0;

$output = 'output/';
mkdir($output);

foreach ($json['log']['entries'] as $e){
    $i++;
    if (@$e['response']['content']['text']){
        $g = parse_url($e['request']['url']);
        $f = pathinfo($g['path']);
    
        mkdir($output . substr($f['dirname'], 1), 0755, true);
    
        file_put_contents($output . substr($f['dirname'], 1) . '/' . $f['filename'] . '.' . $f['extension'], $e['response']['content']['text']);
    }
}

echo $i . ' - ' . $b . "\n";
?>
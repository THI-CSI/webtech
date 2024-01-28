<?php
$filename = "index.html";
if ($_GET["page"]) {
    $filename = $_GET["page"];
}

$absolutePath = realpath($filename);
$baseDir = getcwd();
if($absolutePath !== false) {
    if($baseDir."/".$filename === $absolutePath) {
        $myfile = fopen($filename, "r") or die ("Unable to open file!");
        echo fread($myfile, filesize($filename));
        fclose($myfile);
    } else {
        die ("Unable to open file!");
    }
} else {
    die ("Unable to open file!");
}

?>
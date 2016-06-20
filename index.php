<?php

include 'clsMain.php';


$url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
if(!isset($url) or empty($url)) {
    $url = 'No URL given';
    echo "<form action=\"".filter_input(INPUT_SERVER,'PHP_SELF')."\" method=\"GET\">";
    echo "<input type=\"text\" name=\"url\" size=\"10\" />";
    echo "<input type=\"submit\" value=\"Submit\" />";
    echo "</form>";
} else {
    if(!filter_input(INPUT_GET, 'url', FILTER_VALIDATE_URL)) {
        echo 'URL invalid | '.$url;
    echo "<form action=\"".filter_input(INPUT_SERVER,'PHP_SELF')."\" method=\"GET\">";
    echo "<input type=\"text\" name=\"url\" size=\"20\" value=\"".filter_input(INPUT_GET, 'url')."\" />";
    echo "<input type=\"submit\" value=\"Submit\" />";
    echo "</form>";
    } else {
        $getArticle = $clsMain->printArticle(preg_replace('{news}','m',$url, 1));
        
        echo 'URL OK | '.$url;
        echo "<br />";
        echo 'URL formatted to | '.preg_replace('{news}','m',$url, 1);
        
        echo "<br />";
        echo '[Title] '.$getArticle['Title'];
        echo "<br />";
        echo '[Date] '.$getArticle['Date'];
        echo "<br />";
        echo '[Article] '.$getArticle['Article'];
    }
}


?>
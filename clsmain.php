<?php

class clsMain {
    
    private function getPage($input) {
        $opts = array( 
        'http' => array(
        'method'=>"POST", 
        'header'=>"Content-Type: text/html; charset=utf-8",
        ),); 
        $context  = stream_context_create($opts);
        $result = file_get_contents($input, false, $context);
        return $result;
    }
   
    public function printArticle($input) {
        $fullPage = $this->getPage($input);
        preg_match('{內容頁">(.*?)<\/h2>}',$fullPage,$matches);
        $articleData['Title'] =  $matches[1];
        preg_match('{time">(.*?)<\/div>}',$fullPage,$matches);
        $articleData['Date'] =  $matches[1];
        preg_match('{內文">\n(.*?)<\/div>}',$fullPage,$matches);
        $articleData['Article'] =  $matches[1];
        return $articleData;
    }
    
}

$clsMain = new clsMain();


$getArticle = $clsMain->printArticle("http://m.ltn.com.tw/news/life/breakingnews/1582899");

echo "<br />";
echo '[Title] '.$getArticle['Title'];
echo "<br />";
echo '[Date] '.$getArticle['Date'];
echo "<br />";
echo '[Article] '.$getArticle['Article'];



?>

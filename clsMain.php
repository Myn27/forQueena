<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        preg_match('{???">(.*?)<\/h2>}',$fullPage,$matches);
        $articleData['Title'] =  $matches[1];
        preg_match('{time">(.*?)<\/div>}',$fullPage,$matches);
        $articleData['Date'] =  $matches[1];
        preg_match('{??">\n(.*?)<\/div>}',$fullPage,$matches);
        $articleData['Article'] =  $matches[1];
        return $articleData;
    }
    
}

$clsMain = new clsMain();

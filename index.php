<?php
/**
 * Created by PhpStorm.
 * User: Mostafa Samir
 * Date: 9/17/2018
 * Time: 4:06 PM
 */

    $myUrl = 'https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=1';
    echo $myUrl . '<br/>';
    $urlContent = file_get_contents($myUrl);

    $dom = new DOMDocument();
    @$dom->loadHTML($urlContent);
    $xpath = new DOMXPath($dom);
    $hrefs = $xpath->evaluate("/html/body//a");

    for($i = 0; $i < $hrefs->length; $i++) {
        $href = $hrefs->item($i);
        $url = $href->getAttribute('href');
        $id = preg_match('/(?<=\/)[\d ]+$/', $url);
        if ($id) {
            echo 'Link ' . $i . '<a href="' . $url . '">' . $url . '<br /></a>';
        }
    }

    $nextPage = 2;
    echo substr($myUrl, 0, -1).$nextPage . '<br/>';
    if(@get_headers(substr($myUrl, 0, -1).$nextPage)){
        $urlContent1 = file_get_contents(substr($myUrl, 0, -1).$nextPage);

        $dom1 = new DOMDocument();
        @$dom1->loadHTML($urlContent1);
        $xpath1 = new DOMXPath($dom1);
        $hrefs1 = $xpath1->evaluate("/html/body//a");

        for($i = 0; $i < $hrefs1->length; $i++) {
            $href = $hrefs1->item($i);
            $url = $href->getAttribute('href');
            $id = preg_match('/(?<=\/)[\d ]+$/', $url);
            if ($id) {
                echo 'Link ' . $i . '<a href="' . $url . '">' . $url . '<br /></a>';
            }
        }
    }
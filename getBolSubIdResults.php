<?php
    // Example script where you can retrieve the subid reporting based on a timeframe for the bol.com partnerprogramma. Response can be given in format json and xml
    set_time_limit(240);
    $apiKey = "YOUR API KEY HERE";
    $startDate = '2013-10-01';
    $endDate = '2013-11-01';
    
    $ch = curl_init();
    $type = "json";
    //$type = "xml";
    $headers = array(
               "Accept: application/" . $type,
               "apiKey: " . str_replace(array("\r", "\r\n", "\n"), '', $apiKey),
    );
    //var_dump($headers);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_ENCODING, "" );
    curl_setopt($ch, CURLOPT_AUTOREFERER, true );
    curl_setopt($ch,CURLOPT_TIMEOUT,240);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
    curl_setopt($ch, CURLOPT_URL, "https://partnerprogramma.bol.com/partner/resources/api/1/subid/report/?startDate=".$startDate."&endDate=".$endDate);
    // Execute
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    $response = curl_getinfo( $ch );
    //echo "HttpStatus: " . $response['http_code'] . "<br/>";
    // Check if any error occured
    if(curl_errno($ch)){
        echo 'Error occured while processing request!';
    } else {
        if ("xml" == $type){
            header("Content-Type: application/xhtml+xml; charset=utf-8");
            echo $content;
        } else if ("json" == $type){
            header('Content-type: application/json');
            echo utf8_encode($content);
        }
    
    }
    // Close handle
    curl_close($ch);
?>
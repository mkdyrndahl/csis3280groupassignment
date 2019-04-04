<?php

class RestClientItems {

    static function call($method, $callData) {
        $requestHeader = array('requesttype' => $method);

        $data = array_merge($requestHeader, $callData);

        $options = array('http' => array(
                                    'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                                    'method' => $method,
                                    'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);

        $result = file_get_contents(API_URLITEMS, false, $context);
        
        return $result;
    }

}
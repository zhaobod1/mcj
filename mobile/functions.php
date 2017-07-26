<?php
/**
 * Created by PhpStorm.
 * User: Jason Ding
 * Date: 2017/6/26 14:50
 * Description:
 */

  function fetch($url, $data)
{
    $opts['http']['timeout'] = 3;
    if ($data) {
        $opts['http']['method'] = 'POST';
        $opts['http']['content'] = http_build_query($data);
        $opts['http']['header'] = "Content-type: application/x-www-form-urlencoded\r\n";
        $opts['http']['header'] .= "Content-Length: " . strlen($opts['http']['content']) . "\r\n";
    } else {
        $opts['http']['method'] = 'GET';
    }
    $stream = stream_context_create($opts);
    return file_get_contents($url, false, $stream);
}
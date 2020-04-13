<?php

function l($message)
{
    global $current;
    echo $message . ' (' . (microtime(true) - $current) . ')' . PHP_EOL;
    $current = microtime(true);
}

ini_set('default_socket_timeout', 5);

$start = microtime(true);
$current = microtime(true);

l('start');
$redis = new Redis();
if (!$redis->connect('tls://redis-tls', 6379, 5, null, 5, 5)) {
    throw new RuntimeException($redis->getLastError());
}
l('connected');
$redis->setOption(Redis::OPT_READ_TIMEOUT, 5);
l('option is set');
$redis->auth('some-password');
l('auth complete');
$redis->select(4);
l('db selected');

echo 'Total: ' . (microtime(true) - $start) . PHP_EOL;

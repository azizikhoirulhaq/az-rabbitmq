<?php

require_once '/Users/azizikhoirulhaq/Downloads/composer/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('167.71.202.66', 5672, 'admin', 'Azizi1988!');
$channel = $connection->channel();

$channel->queue_declare('inact-cloud-message-from-php', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('inact-cloud-message-from-php', '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>

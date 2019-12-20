<?php
require_once '/Users/azizikhoirulhaq/Downloads/composer/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('167.71.202.66', 5672, 'admin', 'Azizi1988!');
$channel = $connection->channel();

$channel->queue_declare('inact-cloud-message-from-php', false, false, false, false);

$msg = new AMQPMessage('Message from INACT Cloud - php');
$channel->basic_publish($msg, '', 'inact-cloud-message-from-php');

echo " [x] Sent 'message from INACT Cloud - php'\n";

$channel->close();
$connection->close();
?>

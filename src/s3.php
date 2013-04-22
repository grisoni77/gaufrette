<?php

include __DIR__.'/../vendor/autoload.php';

use Gaufrette\Adapter\AmazonS3 as S3Adapter;

include 'config.php';

$client = new \AmazonS3(array(
    'key' => $aws_access_key,
    'secret' => $aws_secret_key
));
$adapter = new S3Adapter($client, 'gr77-prova');
$filesystem = new \Gaufrette\Filesystem($adapter);

if ( ! $filesystem->has('foo')) {
    $filesystem->write('foo', 'Some content');
}

echo $filesystem->read('foo');



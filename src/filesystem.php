<?php

include __DIR__.'/../vendor/autoload.php';

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use Gaufrette\File;

// create local adapter
$adapter = new LocalAdapter(__DIR__.'/../tmp');
$filesystem = new Filesystem($adapter);

// create file
$filename = 'myFile';
if (!$filesystem->has($filename))
{
    $filesystem->createFile($filename);
    $content = 'Primo testo di prova\n';
    $filesystem->write($filename, $content);
}

// use File object
$file = new File($filename, $filesystem);
$content = 'Secondo testo di prova\n';
$file->setContent($content);

// use file streams
$stream = $file->createStream();
$stream->open(new Gaufrette\StreamMode('a'));
$stream->write('Append this text\n');
$stream->close();

// copy file
$filename2 = 'myFile2';
$filesystem->delete($filename2);
$filesystem->write($filename2, $filesystem->read($filename));
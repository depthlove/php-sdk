<?php
require_once '../autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

$accessKey = 'Access Key';
$secretKey = 'Secret Key';
$auth = new Auth($accessKey, $secretKey);
$bucketMgr = new BucketManager($auth);

$bucket = 'rwxf';
$prefix = '';
$marker = '';
$limit = 3;

list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
if ($err !== null) {
    echo "\n====> list file err: \n";
    var_dump($err);
} else {
    echo "Marker: $marker\n";
    echo "\nList Iterms====>\n";
    var_dump($iterms);
}
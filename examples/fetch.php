<?php
require_once '../autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

$accessKey = 'Access Key';
$secretKey = 'Secret Key';

$auth = new Auth($accessKey, $secretKey);
$bmgr = new BucketManager($auth);

$url = 'http://php.net/favicon.ico';
$bucket = 'rwxf';
$key = time() . '.ico';

list($ret, $err) = $bmgr->fetch($url, $bucket, $key);
echo "=====> fetch $url to bucket: $bucket  key: $key\n";
if ($err !== null) {
    var_dump($err);
} else {
    echo 'Success';
}
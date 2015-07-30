<?php
require_once '../autoload.php';

use Qiniu\Auth;
use Qiniu\Processing\PersistentFop;

//对已经上传到七牛的视频发起异步转码操作 

$accessKey = 'Access Key';
$secretKey = 'Secret Key';
$auth = new Auth($accessKey, $secretKey);

//要转码的文件所在的空间和文件名。
$bucket = 'rwxf';
$key = '1.mp4';

//转码是使用的队列名称。 https://portal.qiniu.com/mps/pipeline
$pipeline = 'abc';
$pfop = new PersistentFop($auth, $bucket, $pipeline);

//要进行转码的转码操作。 http://developer.qiniu.com/docs/v6/api/reference/fop/av/avthumb.html
$fops = "avthumb/mp4/s/640x360/vb/1.25m";

list($id, $err) = $pfop->execute($key, $fops);
echo "\n====> pfop avthumb result: \n";
if ($err != null) {
    var_dump($err);
} else {
    echo "PersistentFop Id: $id\n";
}

//查询转码的进度和状态
list($ret, $err) = $pfop->status($id);
echo "\n====> pfop avthumb status: \n";
if ($err != null) {
    var_dump($err);
} else {
    var_dump($ret);
}
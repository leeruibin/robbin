<?php
//git webhook �Զ�����ű�
//��Ŀ�������·��
$path = "/storage/wwwroot/qy.a.net/";
$requestBody = file_get_contents("php://input");
if (empty($requestBody)) {
    die('send fail');
}
$content = json_decode($requestBody, true);
//��������֧���ύ������0
if ($content['ref']=='refs/heads/master' && $content['total_commits_count']>0) {
    $res = shell_exec("cd {$path} && git pull 2>&1");//��www�û�����
    $res_log = '-------------------------'.PHP_EOL;
    $res_log .= $content['user_name'] . ' ��' . date('Y-m-d H:i:s') . '��' . $content['repository']['name'] . '��Ŀ��' . $content['ref'] . '��֧push��' . $content['total_commits_count'] . '��commit��' . PHP_EOL;
    $res_log .= $res.PHP_EOL;
    file_put_contents("git-webhook.txt", $res_log, FILE_APPEND);//׷��д��
}
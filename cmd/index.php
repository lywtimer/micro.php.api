<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define("APP_PATH",  realpath(dirname(__FILE__)));
require_once APP_PATH . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
//var_dump($request->request->all());
//var_dump($request->query->all());
//var_dump($request->getUri());
//var_dump($request->getPathInfo());
//var_dump($_SERVER["REQUEST_URI"]);
$path = $request->getPathInfo();


if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path))
    return false;    // 直接返回请求的文件
elseif (preg_match('/\.(?:service)$/', $path))
    $server = (new Yar_Server(new Operator()))->handle();
else {
//    echo "<p>Welcome to PHP</p>";
    \mszlu\memory\Engine::getInstance("")->run();
    $response = new Response();
    $response->setStatusCode(Response::HTTP_OK);
    $response->headers->set("Content-Type", "application/json;charset=utf-8");
    $response->setContent(json_encode(["hello" => "小鬼", "msg" => "<p>Welcome to PHP</p>"]));
    $response->send();
}
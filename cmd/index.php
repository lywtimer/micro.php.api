<?php

use mszl\core\middleware\AbstractMiddleware;
use mszl\core\middleware\MiddlewareStack;
use Symfony\Component\HttpFoundation\Request;

define("APP_PATH", realpath(dirname(__FILE__)));
require_once APP_PATH . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$path = $request->getPathInfo();


if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path))
    return false;    // 直接返回请求的文件
elseif (preg_match('/\.(service)$/', $path))
    $server = (new Yar_Server(new StdClass()))->handle();
else {
    class OrderMiddleware extends AbstractMiddleware
    {

        public function handle($context, MiddlewareStack $stack)
        {
            $context->write(json_encode(["code" => 200, "msg" => "success"]));
        }
    }
    \mszl\core\Engine::getInstance()->addMiddleware(new OrderMiddleware())->run();

}
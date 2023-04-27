<?php

use mszl\core\middleware\AbstractMiddleware;
use mszl\core\middleware\MiddlewareStack;
use Symfony\Component\HttpFoundation\Request;

define("APP_PATH", realpath(dirname(__FILE__)));
require_once APP_PATH . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
//var_dump($request->getUri());
$path = $request->getPathInfo();


class Demo extends AbstractMiddleware
{

    public function handle(\mszl\core\context\Context $context, MiddlewareStack $stack)
    {
        // TODO: Implement handle() method.
        $context->write(json_encode(["code" => 200, "msg" => "success", "request" => $context->getRequest()]));
    }
}

$pattern = '/(?<className>\w+)\.(?<serverType>\w+)/';
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path))
    return false;    // 直接返回请求的文件
elseif (preg_match($pattern, $path, $matches)) {
    $className = 'service\\' . $matches['className'];
    $serverType = $matches['serverType'];
    match ($serverType) {
        'service' => (new Yar_Server(new $className))->handle(),
    };
} else {
//    \mszl\core\Engine::getInstance()->addMiddleware(new Demo())->run();
}


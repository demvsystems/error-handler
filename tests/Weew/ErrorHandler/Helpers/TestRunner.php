<?php

namespace Tests\Weew\ErrorHandler\Helpers;

use Weew\Http\HttpRequest;
use Weew\Http\HttpRequestMethod;
use Weew\HttpClient\HttpClient;
use Weew\HttpServer\HttpServer;
use Weew\Url\Url;

class TestRunner {
    public function runInCliMode($file) {
        return shell_exec('php -f ' . $this->getFilePath($file));
    }

    public function runInHttpMode($file) {
        $server = new HttpServer('localhost', 9000, $this->getFilePath($file));
        $server->start();

        $client = new HttpClient();
        $request = new HttpRequest(
            HttpRequestMethod::GET, new Url('localhost:9000')
        );
        $response = $client->send($request);

        $server->stop();

        return $response->getContent();
    }

    protected function getFilePath($file) {
        return __DIR__ . '/../errors/' . $file;
    }
}

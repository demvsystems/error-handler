<?php

namespace Tests\Weew\ErrorHandler\Helpers;

use Weew\Http\HttpRequest;
use Weew\Http\HttpRequestMethod;
use Weew\HttpClient\HttpClient;
use Weew\HttpServer\HttpServer;
use Weew\Url\Url;

class TestRunner {
    public function runInCliMode($file) {
        return shell_exec(s('php -f %s',  $this->getFilePath($file)));
    }

    public function runInHttpMode($file) {
        $server = new HttpServer('localhost', 56789, $this->getFilePath($file));
        $server->start();

        $client = new HttpClient();
        $request = new HttpRequest(
            HttpRequestMethod::GET, new Url('localhost:56789')
        );
        $response = $client->send($request);

        $server->stop();

        return $response->getContent();
    }

    protected function getFilePath($file) {
        return path(__DIR__, '../error_tests', $file);
    }
}

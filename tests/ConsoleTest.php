<?php

namespace ReedJones\Phase\Tests;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as BaseResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ConsoleTest extends TestCase
{
    public function test_artisan_command_table()
    {
        Artisan::call('phase:routes');

        $resultAsText = Artisan::output();

        $this->assertSame(
            "+--------------+-----+---------------------------+------------+\n".
            "| Group Prefix | URI | Navigation Name           | Middleware |\n".
            "+--------------+-----+---------------------------+------------+\n".
            "|              | /   | TestController@HelloWorld |            |\n".
            "+--------------+-----+---------------------------+------------+\n",
            $resultAsText);
    }

    public function test_artisan_command_json()
    {
        Artisan::call('phase:routes --json');

        $resultAsText = Artisan::output();

        $this->assertSame(
            '[{"prefix":null,"uri":"\/","name":"TestController@HelloWorld","middleware":""}]'."\n",
            $resultAsText);
    }

    public function test_artisan_command_json_config()
    {
        Artisan::call('phase:routes --json --config');

        $resultAsText = Artisan::output();

        $this->assertSame(
            '{"config":{"entry":"phase::app","unauthorized":"Auth.LoginPage","ssr":false,"assets":{"scripts":["js\/app.js"],"styles":["css\/app.css"]}},"routes":[{"prefix":null,"uri":"\/","name":"TestController@HelloWorld","middleware":""}]}'."\n",
            $resultAsText);
    }
}

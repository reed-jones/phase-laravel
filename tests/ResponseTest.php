<?php

namespace ReedJones\Phase\Tests;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as BaseResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ResponseTest extends TestCase
{
    public function test_page_view_response()
    {
        $response = $this->get('/');
        $view = $response->getOriginalContent();

        $this->assertInstanceOf(View::class, $view);
        $this->assertSame("<h1>Hello World</h1>\n", $view->render());
    }

    public function test_xhr_response()
    {
        $response = $this->getJson('/');

        $response->assertStatus(200);
        $response->assertJson(['$vuex' => []]);
    }
}

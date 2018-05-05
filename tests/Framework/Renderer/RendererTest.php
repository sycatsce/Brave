<?php

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Renderer\PHPRenderer;

class RendererTest extends TestCase
{
    /**
     * @var PHPRenderer
     */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new PHPRenderer(__DIR__ .'/views');
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('test', __DIR__ .'/views');
        $content = $this->renderer->render('@test/test');
        $this->assertEquals('Test', $content);
    }

    public function testRenderTheDefaultPath()
    {
        $content = $this->renderer->render('test');
        $this->assertEquals('Test', $content);
    }

    public function testGlobalParameters()
    {
        $this->renderer->addGlobal('name', 'Ichigo');
        $content = $this->renderer->render('testParams');
        $this->assertEquals('Character : Ichigo', $content);
    }
    public function testRenderWithParams()
    {
        $this->renderer->addPath(__DIR__ .'/views');
        $content = $this->renderer->render('testParams', ['name' => 'Ichigo']);
        $this->assertEquals('Character : Ichigo', $content);
    }
}

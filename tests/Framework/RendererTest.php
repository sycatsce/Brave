<?php

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Renderer;

class RendererTest extends TestCase
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('test', __DIR__ .'/views');
        $content = $this->renderer->render('@test/test');
        $this->assertEquals('Test', $content);
    }

    public function testRenderTheDefaultPath()
    {
        $this->renderer->addPath(__DIR__ .'/views');
        $content = $this->renderer->render('test');
        $this->assertEquals('Test', $content);
    }
}

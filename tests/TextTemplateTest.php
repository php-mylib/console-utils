<?php
/**
 * Created by PhpStorm.
 * User: Inhere
 * Date: 2017/12/24 0024
 * Time: 15:32
 */

namespace Inhere\Extra\Tests;

use Inhere\Extra\Components\TextTemplate;
use PHPUnit\Framework\TestCase;

/**
 * Class TextTemplateTest
 * @package Inhere\Console\Tests\Components
 * @covers \Inhere\Extra\Components\TextTemplate
 */
class TextTemplateTest extends TestCase
{
    public function testRender()
    {
        $tpl = <<<EOF
test tpl on date {\$date}

use array {\$map.0} {\$map.key1}{* comments *}
EOF;
        $date = date('Ymd');

        $tt = new TextTemplate([
            'name' => 'test',
            'date' => $date,
            'map' => [
                'VAL0',
                'key1' => 'VAL1',
            ],
        ]);

        $ret = $tt->render($tpl);
        $this->assertNotEmpty($ret);
        $this->assertTrue((bool)strpos($ret, $date));
        $this->assertTrue((bool)strpos($ret, 'VAL0'));
        $this->assertStringEndsWith('VAL1', $ret);
    }

    public function testInclude()
    {
        $date = date('Ymd');
        $tt = new TextTemplate([
            'name' => 'test',
            'date' => $date,
            'map' => [
                'VAL0',
                'key1' => 'VAL1',
            ],
        ]);

        $ret = $tt->renderFile(__DIR__ . '/files/text-1.tpl');
        // var_dump($ret);
        $this->assertTrue((bool)strpos($ret, $date));
        $this->assertSame(0, strpos($ret, 'VAL0'));
        $this->assertStringEndsWith('VAL1', $ret);
    }
}

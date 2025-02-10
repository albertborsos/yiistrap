<?php
use Codeception\Util\Stub;

require(__DIR__ . '/../../helpers/TbArray.php');

class TbArrayTest extends TbTestCase
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    public function testGetValue()
    {
        $array = ['key' => 'value'];
        $this->assertEquals('value', TbArray::getValue('key', $array));
    }

    public function testPopValue()
    {
        $array = ['key' => 'value'];
        $this->assertEquals('value', TbArray::popValue('key', $array));
        $this->assertArrayNotHasKey('key', $array);
    }

    public function testDefaultValue()
    {
        $array = [];
        TbArray::defaultValue('key', 'default', $array);
        $this->assertEquals('default', TbArray::getValue('key', $array));
        TbArray::defaultValue('key', 'value', $array);
        $this->assertEquals('default', TbArray::getValue('key', $array));
    }

    public function testDefaultValues()
    {
        $array = ['my' => 'value'];
        TbArray::defaultValues(['these' => 'are', 'my' => 'defaults'], $array);
        $this->assertEquals('are', TbArray::getValue('these', $array));
        $this->assertEquals('value', TbArray::getValue('my', $array));
    }

    public function testRemoveValue()
    {
        $array = ['key' => 'value'];
        TbArray::removeValue('key', $array);
        $this->assertArrayNotHasKey('key', $array);
    }

    public function testRemoveValues()
    {
        $array = ['these' => 'are', 'my' => 'values'];
        TbArray::removeValues(['these', 'my'], $array);
        $this->assertArrayNotHasKey('these', $array);
        $this->assertArrayNotHasKey('my', $array);
    }

    public function testCopyValues()
    {
        $a = ['key' => 'value'];
        $b = [];
        $array = TbArray::copyValues(['key'], $a, $b);
        $this->assertEquals($a, $array);
        $a = ['key' => 'value'];
        $b = ['key' => 'other'];
        $array = TbArray::copyValues(['key'], $a, $b, true);
        $this->assertEquals($a, $array);
    }

    public function testMoveValues()
    {
        $a = ['key' => 'value'];
        $b = [];
        $array = TbArray::moveValues(['key'], $a, $b);
        $this->assertArrayNotHasKey('key', $a);
        $this->assertEquals('value', TbArray::getValue('key', $array));
        $a = ['key' => 'value'];
        $b = ['key' => 'other'];
        $array = TbArray::moveValues(['key'], $a, $b, true);
        $this->assertEquals('value', TbArray::getValue('key', $array));
    }

    public function testMerge()
    {
        $a = ['this' => 'is', 'array' => 'a'];
        $b = ['is' => 'this', 'b' => 'array'];
        $array = TbArray::merge($a, $b);
        $this->assertEquals('is', TbArray::getValue('this', $array));
        $this->assertEquals('a', TbArray::getValue('array', $array));
        $this->assertEquals('this', TbArray::getValue('is', $array));
        $this->assertEquals('array', TbArray::getValue('b', $array));
    }
}
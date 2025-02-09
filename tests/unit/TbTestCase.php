<?php

require(__DIR__ . '/../../vendor/yiisoft/yii/tests/TestApplication.php');
require(__DIR__ . '/../../vendor/yiisoft/yii/framework/collections/CMap.php');

class TbTestCase extends \Codeception\TestCase\Test
{
    /**
     *
     */
    protected function _after()
    {
        $this->destroyApplication();
    }

    /**
     * @param array $config
     * @param string $appClass
     */
    protected function mockApplication($config = [], $appClass = 'TestApplication')
    {
        $defaultConfig = [
            'basePath' => __DIR__,
            'aliases' => [
                'bootstrap' => __DIR__ . '/../..',
            ],
        ];
        Yii::createApplication(
            $appClass,
            CMap::mergeArray($defaultConfig, $config)
        );
    }

    /**
     *
     */
    protected function destroyApplication()
    {
        Yii::setApplication(null);
    }

    /**
     * @param $widgetClass
     * @param array $properties
     * @return string
     */
    protected function runWidget($widgetClass, $properties = [])
    {
        return $this->mockController()->widget($widgetClass, $properties, true);
    }

    /**
     * @param $widgetClass
     * @param array $properties
     * @return CWidget
     */
    protected function beginWidget($widgetClass, $properties = [])
    {
        return $this->mockController()->beginWidget($widgetClass, $properties);
    }

    /**
     * @return CController
     */
    private function mockController()
    {
        return new CController('dummy');
    }
}
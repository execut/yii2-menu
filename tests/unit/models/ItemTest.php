<?php


namespace execut\menu\models;

use execut\crudFields\fields\Field;

class ItemTest extends \Codeception\Test\Unit
{
    public function testValidateLinkWithWrongChar() {
        $item = new Item();
        $item->scenario = Field::SCENARIO_FORM;
        $url = '/test/test?';
        $item->link_url = $url;
        $this->assertFalse($item->validate(['link_url']));
        $this->arrayHasKey('link_url', $item->errors);
        $this->assertIsArray($item->errors['link_url']);
        $this->assertEquals('Allowed only next chars: /-a-Z', $item->errors['link_url'][0]);
    }

    public function testValidateUrl() {
        $item = new Item();
        $item->scenario = Field::SCENARIO_FORM;
        $url = 'http://test.ru/test/test';
        $item->link_url = $url;
        $this->assertTrue($item->validate(['link_url']));
    }

    public function testGetItemItems() {
        $item = new Item();
        $item->name = 'test';
        $item->link_url = 'test';
        $item->sort = 123;
        $items = [
            $item,
        ];

        $itemItems = Item::getItemItems($items);
        $this->assertEquals([
            [
                'label' => 'test',
                'url' => 'test',
                'sort' => 123,
                'items' => [],
            ]
        ], $itemItems);
    }
}
<?php

use PHPUnit\Framework\TestCase;

require_once '../model/CartModel.class.php';


//Проверка функции расчёта общей стоимости и количества предметов в корзине.

class CartTest extends TestCase
{
    /**
     * @dataProvider cart_data_provider
     */

    public function testCount($cart, $expected)
    {
        $this->assertSame($expected, CartModel::get_total_count_cost_render($cart));
    }

    public function cart_data_provider()
    {
        return [
            [
                array(
                    0 =>
                        array(
                            'count' => '2',
                            'cost' => '4'
                        ),
                ),
                ['total_cost' => 8, 'total_count' => 2]
            ],

            [
                array(
                    0 =>
                        array(
                            'count' => '2',
                            'cost' => '4'
                        ),
                    1 =>
                        array(
                            'count' => '2',
                            'cost' => '8'
                        ),
                ),
                ['total_cost' => 24, 'total_count' => 4]
            ],
            [array(), ['total_cost' => 0, 'total_count' => 0]],
            [array(), ['total_cost' => 1, 'total_count' => 1]]
        ];
    }
}
<?php
//1. Создать структуру классов ведения товарной номенклатуры.
//а) Есть абстрактный товар.
//б) Есть цифровой товар, штучный физический товар и товар на вес.
//в) У каждого есть метод подсчета финальной стоимости.
//г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
//д) Что можно вынести в абстрактный класс, наследование?
//2. *Реализовать паттерн Singleton при помощи traits.

const N = '<br>';

abstract class Item
{
    protected $id;
    protected $name;
    protected $cost;
    protected $description;
    protected $photo;

    const N = '<br>';

    function __construct($id, $name, $cost, $description, $photo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->description = $description;
        $this->photo = $photo;
    }

    public function setName($name)
    {
        $this->$name = $name;
    }

    public function getName($name)
    {
        return $this->$name;
    }

    function render()
    {
        echo 'id: ' . $this->id . self::N .
            'name: ' . $this->name . self::N .
            'cost: ' . $this->cost . self::N .
            'description: ' . $this->description . self::N .
            'photo: ' . $this->photo . self::N;
    }

    abstract function get_cost();

    abstract function get_profit();
}

class Thing extends Item
{
    function get_cost()
    {
        return $this->cost;
    }

    function get_profit()
    {
        return $this->cost * 0.1;
    }
}

class Digital extends Item
{
    function get_cost()
    {
        return $this->cost / 2;
    }

    function get_profit()
    {
        return $this->cost * 0.2;
    }
}

class Weighted_goods extends Item
{
    private $weight;

    function __construct($id, $name, $cost, $description, $photo, $weight)
    {
        parent::__construct($id, $name, $cost, $description, $photo);
        $this->weight = $weight;
    }

    function render()
    {
        parent::render();
        echo 'weight: ' . $this->weight . self::N;
    }

    function get_cost()
    {
        return $this->cost * $this->weight;
    }

    function get_profit()
    {
        return $this->cost * 0.25 * $this->weight;
    }
}

$thing = new Thing(0, 'thing', '10', 'thing-description', 'thing-photo');
$digital = new Digital(1, 'digital', '20', 'digital-description', 'digital-photo');
$weighted = new Weighted_goods(2, 'weighted', '30', 'weighted-description', 'weighted-photo', 2);

$thing->render();
echo 'cost = ' . $thing->get_cost() . N;
echo 'profit = ' . $thing->get_profit() . N . N;

$digital->render();
echo 'cost = ' . $digital->get_cost() . N;
echo 'profit = ' . $digital->get_profit() . N . N;

$weighted->render();
echo 'cost = ' . $weighted->get_cost() . N;
echo 'profit = ' . $weighted->get_profit() . N . N;
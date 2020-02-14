<?php
//1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
//2. Описать свойства класса из п.1 (состояние).
//3. Описать поведение класса из п.1 (методы).
//4. Придумать наследников класса из п.1. Чем они будут отличаться?

class Item
{
    private $id;
    private $name;
    private $cost;
    private $description;
    private $photo;

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
}

class Game extends Item
{
    private $console_type;
    private $game_type;
    function __construct($id, $name, $cost, $description, $photo, $console_type, $game_type)
    {
        $this->console_type = $console_type;
        $this->game_type = $game_type;
        parent::__construct($id, $name, $cost, $description, $photo);
    }
    function render()
    {
        parent::render();
        echo 'console_type: ' . $this->console_type . self::N . 'game_type: ' . $this->game_type . self::N;
    }
}
$item = new Item(0, 'товар', 10, 'описание', 'ссылка на фото');
$item->render();
echo '<br>';
$game = new Game(0, 'Castlevania', 16, 'компьютерная игра', 'ссылка на фото', 'nes', 'платформер');
$game->render();

//    5. Дан код:
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A();
//$a2 = new A();
//$a1->foo();
//$a2->foo();
//$a1->foo();
//$a2->foo();
//Что он выведет на каждом шаге? Почему?

//ОТВЕТ: Код выведет 1234, потому что присваивание статической локальной переменной выполняется только один раз.



//    Немного изменим п.5:
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//class B extends A {
//}
//$a1 = new A();
//$b1 = new B();
//$a1->foo();
//$b1->foo();
//$a1->foo();
//$b1->foo();
//6. Объясните результаты в этом случае.

//ОТВЕТ: Код выведет 1122, так как у класса А и у класса В статические переменные разные.




//7. *Дан код:
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//class B extends A {
//}
//$a1 = new A;
//$b1 = new B;
//$a1->foo();
//$b1->foo();
//$a1->foo();
//$b1->foo();
//Что он выведет на каждом шаге? Почему?
//ОТВЕТ: Код такой же как в предыдущеи задании, и вывод будет тот же: 1122
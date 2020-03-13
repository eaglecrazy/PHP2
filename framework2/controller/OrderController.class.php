<?php


class OrderController extends Controller
{
    public $title = 'Оформление заказа';
    public $view_dir = 'order';
    private $finality = false;

    //вывод заказа
    public function index($data)
    {
        $cart = CartModel::get_items();
        $total_count_cost = CartModel::get_total_count_cost_render($cart);
        return [
            'cart' => $cart,
            'total_cost' => $total_count_cost['total_cost'],
        ];
    }

    //добавление заказа в БД
    public function add($data)
    {
        //если нужна регистрация
        if ($_POST['login'] && $_POST['password']) {
            $result = UserModel::add_user($_POST['login'], $_POST['password']);
            //если не удалось добавить
            if (!$result) {
                $this->view_name = 'error';
                $this->view_dir = 'registration';
                return false;
            }

            //если зарегистрировались, то войдём в аккаунт
            UserModel::enter_account($_POST['login'], $_POST['password']);

            //и перенесём бронь из кук в БД
            CartModel::move_cart_from_cookie_to_db();
        }

        $this->title = 'Заказ оформлен';
        $this->view_name = 'orderend';
        $this->finality = true;

        //сумма к оплате
        $cost_total = CartModel::get_total_count_cost_render(CartModel::get_items())['total_cost'];
        //вводим заказ в таблицу
        $order_num = OrderModel::add_order($_POST);
        //список покупок
        $order_items = OrderModel::get_order_items($order_num);

        return ['items' => $order_items, 'num' => $order_num, 'cost' => $cost_total];
    }

    public function getHeaderLinks()
    {
        $links = parent::getHeaderLinks();
        return $links;
    }

    public function getScripts()
    {
        $scripts =
            str_replace('@', Config::get('js_jquery'), Config::get('js')) .
            str_replace('@', Config::get('js_authorisation'), Config::get('js'));
        if(!$this->finality)
            $scripts .= str_replace('@', Config::get('js_validation'), Config::get('js')) .
            str_replace('@', Config::get('js_order'), Config::get('js'));
        return $scripts;
    }

}
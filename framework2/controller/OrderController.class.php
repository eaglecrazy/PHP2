<?php
class OrderController extends Controller
{
    public $title = 'Оформление заказа';
    public $view_dir = 'order';
    private $end = false;//флаг завершения заказа

    //вывод заказа перед подтверждением
    public function index($data)
    {
        $cart = CartModel::get_items();
        //если корзина пуста на этой страничке нечего делать
        if(empty($cart))
            $this->goToIndex();

        $total_count_cost = CartModel::get_total_count_cost_render($cart);
        return [
            'cart' => $cart,
            'total_cost' => $total_count_cost['total_cost'],
        ];
    }

    //итоговый вывод заказа
    public function end($data){

        $order_num = $data['id'];

        $client_id = UserModel::get_id();
        //если клиент не авторизован, то ему тут нечего делать
        if($client_id === -1)
            $this->goToIndex();
        //заказ нужно отобразить если авторизован именно тот пользователь, что его делал
        //заодно проверяется существование заказа
        if(!OrderModel::checkUserToOrder($client_id, $order_num))
            $this->goToIndex();

        $this->title = 'Заказ оформлен';
        $this->end = true;

        $cost_total = CartModel::get_total_count_cost_render(CartModel::get_items($order_num))['total_cost'];

        //список покупок
        $order_items = OrderModel::get_order_items($order_num);

        return ['items' => $order_items, 'num' => $order_num, 'cost' => $cost_total];
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

        //вводим заказ в таблицу
        $order_num = OrderModel::add_order($_POST);

        //отправим номер заказа для перехода на страницу завершения заказа
        die($order_num);
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
        if(!$this->end)
            $scripts .= str_replace('@', Config::get('js_validation'), Config::get('js')) .
            str_replace('@', Config::get('js_order'), Config::get('js'));
        return $scripts;
    }

    private function goToIndex(){
        header('Location: index.php');
        die();
    }

}
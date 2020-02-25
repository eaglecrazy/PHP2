<?php
//настроим ссылки в хидере
$link_index = LINK_INDEX;
$link_cart = LINK_CART;
$link_form = LINK_FORM;
if ($_SERVER['REQUEST_URI'] === str_replace('..', '', LINK_INDEX))
    $link_index = LINK_EMPTY;
else if ($_SERVER['REQUEST_URI'] === str_replace('..', '', LINK_CART))
    $link_cart = LINK_EMPTY;
else if ($_SERVER['REQUEST_URI'] === str_replace('..', '', LINK_FORM))
    $link_form = LINK_EMPTY;

if($active_user) {//авторизация была пройдена
    $enter_exit = "
        <form action=\"../server/exit.php\">
            <input type=\"submit\" class=\"button headerButton\" value=\"Выход\">
        </form>";
    $user = "<div class=\"user-info-wrap\"><div class=\"user-info\">$active_user</div></div>";
} else {//авторизация не пройдена
    $enter_exit = "<button class=\"button headerButton\" id=\"button-enter\">Вход</button>";
}



$header = "
    $user
    <div class=\"menuLeft\">
        <a href=\"$link_index\" class=\"button indexButton\">Магазин</a>
        <a href=\"$link_form\" class=\"button formButton hidden\">Обратная связь</a>
    </div>
    <div class=\"menuRight\">
        <form class=\"searchForm hidden\"><input type=\"text\" placeholder=\"\" class=\"searchInput form-input\">
            <button class=\"button searchButton\">Поиск</button>
        </form>
        <a  href=\"$link_cart\" class=\"button headerButton\">Корзина</a>
        $enter_exit
    </div>
    <div class=\"modal hidden\" id=\"modal\"></div>";


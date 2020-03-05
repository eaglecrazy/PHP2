<?php

$styles .= '<link rel="stylesheet" href="../styles/form.css">';

$main =
"<h2 class=\"form-heading\">Регистрация</h2>
<div class=\"form-wrap\">
    <form action=\"../server/index.twig.php\" class=\"form\" method='POST'>
        <label for=\"input-login\" class=\"form-label\">Ваш логин:</label>
        <input class=\"form-add-input\" type=\"text\" id=\"input-login\" name=\"login\" required>
        <label for=\"input-password\" class=\"form-label\">Ваш пароль:</label>
        <input class=\"form-add-input\" type=\"password\" id=\"input-password\" name=\"password\" required>
        <input type=\"submit\" class=\"button form-button\" value=\"Отправить\">
    </form>
</div>";


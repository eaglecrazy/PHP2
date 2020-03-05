
echo
"<button class=\"modal-close\" id=\"modal-close\">X</button>
<form action=\"../server/authorisation.php\" method=\"POST\" class=\"modal-form\">
    <h3 class=\"modal-heading\">Введите логин и пароль.</h3>
    <fieldset class=\"modal-input-wrap\">
        <label for=\"login\">логин:</label>
        <input type=\"text\" name=\"login\" id=\"login\" required>
    </fieldset>
    <fieldset class=\"modal-input-wrap\">
        <label for=\"password\">пароль:</label>
        <input type=\"password\" name=\"password\" id=\"password\" required>
    </fieldset>
    <input type=\"submit\" value=\"войти\" class=\"button\">
</form>
<a href=\"../pages/registration.twig-page.php\" class=\"button\" id=\"registration.twig-button\">регистрация</a>";
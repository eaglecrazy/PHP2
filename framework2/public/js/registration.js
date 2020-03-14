$('#button-registration').click((e) => {
    e.preventDefault();

    //так как поведение по умолчанию отменили валидация не проходит, поэтому проведём её вручную
    if(noValidation(document.getElementById('input-login'), 'Нужно ввести логин!'))
        return;
    if(noValidation(document.getElementById('input-password'), 'Нужно ввести пароль!'))
        return;

    const data = {
        'login': $('#input-login').val(),
        'password': $('#input-password').val()
    };

    $.ajax({
        url: 'index.php?path=user/add_user',
        type: 'POST',
        dataType: 'text',
        data: data,
        success: (answer) => {
            //если всё ок, то перейдём на главную
            if (answer === 'OK') {
                window.location.href = "index.php";
                return;
            }
            //а вот если пришёл ответ, то покажем модальное окно,
            if($modal.text())
                $modal.text('');
            $modal.append(answer);
            //повесим событие на закрытие окна
            $('#modal-close').click((e) => {
                $modal.fadeOut('fast');
                $modal.text('');
            });
            $modal.fadeIn('fast');
        },
        fail: () => {
            alert('Ошибка регистрации.');
        }
    });
});
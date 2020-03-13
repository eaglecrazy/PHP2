$('#button-order').click((e) => {
    e.preventDefault();

    //так как поведение по умолчанию отменили валидация не проходит, поэтому проведём её вручную
    const login = document.getElementById('input-login');
    //валидация нужна только если есть логин
    if (login && noValidation(login, 'Нужно ввести логин!'))
        return;
    //валидация нужна только если есть пароль
    const password = document.getElementById('input-password');
    if (password && noValidation(password, 'Нужно ввести пароль!'))
        return;
    if (noValidation(document.getElementById('input-name'), 'Нужно ввести имя получателя!'))
        return;
    if (noValidation(document.getElementById('input-phone'), 'Нужно ввести телефон!'))
        return;
    if (noValidation(document.getElementById('input-adress'), 'Нужно ввести адрес!')) {
        return;
    }

    const data = {
        'name': $('#input-name').val(),
        'phone': $('#input-phone').val(),
        'adress': $('#input-adress').val(),
        'comment': $('#input-comment').val(),
    };

    if (login && password) {
        data.login = login.value;
        data.password = password.value;
    }

    $.ajax({
        url: 'index.php?path=order/add',
        type: 'POST',
        dataType: 'text',
        data: data,
        success: (answer) => {
            //сервер прислал страницу
            let test = answer.indexOf('<main class="main">');
            if (test) {
                document.innerHTML = answer;
            } else {
                if ($modal.text())
                    $modal.text('');
                $modal.append(answer);
                //повесим событие на закрытие окна
                $('#modal-close').click((e) => {
                    $modal.fadeOut('fast');
                    $modal.text('');
                });
                $modal.fadeIn('fast');
            }
        },
        fail: () => {
            alert('Ошибка добавления заказа.');
        }
    });

});
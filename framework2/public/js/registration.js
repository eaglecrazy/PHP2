const $button_reg = $('#button-registration');

$button_reg.click((e) => {

    e.preventDefault();

    const data = {
        'asAjax': true,
        'path': 'index.php?path=registration/add',
        'login': $('#input-login').val(),
        'password' : $('#input-password').val()
    };

    alert(data.password);
    // $.ajax();

    // $.get('index.php?path=registration', (page) => {
    //     if($modal.text())
    //         return;
    //     $modal.append(page);
    //     //повесим событие на закрытие окна
    //     $('#modal-close').click((e) => {
    //         $modal.fadeOut('fast');
    //         $modal.text('');
    //     });
    // }).fail(() => {
    //     alert('Не удалось загрузить модальное окно');
    // });
    // $modal.fadeIn('fast');
});



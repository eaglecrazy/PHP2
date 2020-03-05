const $button_enter = $('#button-enter');
const $modal = $('#modal');

$button_enter.click((e) => {
    $.get('index.php?path=authorisation', (page) => {
        $modal.append(page);
        //повесим событие на закрытие окна
        $('#modal-close').click((e) => {
            $modal.fadeOut('fast');
            $modal.text('');
        });
    }).fail(() => {
        alert('Не удалось загрузить модальное окно');
    });
    $modal.fadeIn('fast');
});

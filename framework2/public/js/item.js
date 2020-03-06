const $button_add = $('.item-info-button');
//$modal уже объявлен в хидере
// const $modal = $('#modal');
const T = 1900;

$button_add.click((e) => {
    $.get('index.php?path=cart/add/' + e.target.id, (page) => {
        // $modal.addClass('hidden');
        $modal.append(page);
        $modal.fadeIn(0);
        $modal.fadeOut(T);
        $button_add.prop("disabled", true);
        setTimeout(() => {
            $button_add.prop("disabled", false);
            $modal.text('');
        }, T);

    }).fail(() => {
        alert('Не удалось загрузить модальное окно');
    });

});

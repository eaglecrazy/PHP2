let $modal = $('#modal');

// $('.table-control').change((e) => {
//         let id = e.target.getAttribute('id');
//         id = id.replace('status-', '');
//
//         $.get(`../server/edit-order.php?id=${id}&status=${e.target.value}`, (page) => {
//             const T = 1500;
//             $modal.append(page);
//             $modal.fadeIn(0);
//             $modal.fadeOut(T);
//             $button_add.prop("disabled", true);
//             setTimeout(() => {$button_add.prop("disabled", false);}, T);
//             $modal.text('');
//         })
//         .fail(() => {
//             alert('Не удалось изменить статус заказа');
//         });
//     }
// );

$('.button-table-control').click((e) => {
    const id = e.target.getAttribute('id');

    $.get(`index.php?path=admin_orders/show/${id}`, (page) => {
        if ($modal.text())
            $modal.text('');
        $modal.addClass('order-modal');
        $modal.append(page);
        //повесим событие на закрытие окна
        $('#modal-close').click(() => {
            $modal.fadeOut('fast');
            $modal.removeClass('order-modal');
            $modal.text('');
        });
        $modal.fadeIn(100);
    })
    .fail(() => {
        alert('Не удалось загрузить модальное окно');
    });
});

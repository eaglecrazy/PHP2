//удаление элемента
$('.cart-item-cross').click((e) => {
    const id = e.target.id.replace('cross-', '');

    data = {
        'asAjax': true,
        'path': 'cart/delete',
        'id': id
    };


    $.ajax({
        url: 'index.php?cart/delete',
        type: 'GET',
        dataType: 'text',
        data: data,
        success: (answer) => {
            $('#' + id).remove();
            const result = JSON.parse(answer);
            const total_count = result['total_count'];
            const total_cost = result['total_cost'];
            $('.cart-info-quantity').text(total_count + ' шт.');
            $('.cart-info-price').text(total_cost + ' руб.');

            //если удалили последний товар в корзине, то нужно убрать кнопку "оформить заказ"
            if (!total_count)
                $('.cart-issue-button').remove();
        },
        fail: () => {alert('Не удалось удалить ' + id)}
    });
});

//     $.ajax(`index.php?cart/edit`, ((answer) => {
//         $('#' + id).remove();
//         const result = JSON.parse(answer);
//         const total_count = result['total_count'];
//         const total_cost = result['total_cost'];
//         $('.cart-info-quantity').text(total_count + ' шт.');
//         $('.cart-info-price').text(total_cost + ' руб.');
//
//         //если удалили последний товар в корзине, то нужно убрать кнопку "оформить заказ"
//         if(!total_count)
//             $('.cart-issue-button').remove();
//
//     }))
//     .fail(() => {
//         alert('Не удалось удалить ' + id);
//     });
// });


//изменение количества
$('.cart-item-quantity').change((e) => {
    const id = e.target.id.replace('input-', '');
    const count = e.target.value;
    $.get(`index.php?cart/edit/${id}/${count}`, ((answer) => {
        const result = JSON.parse(answer);
        const total_count = result['total_count'];
        const total_cost = result['total_cost'];
        const current_cost = result['current_cost'];
        $('.cart-info-quantity').text(total_count + ' шт.');
        $('.cart-info-price').text(total_cost + ' руб.');
        $('#cost-' + id).text(`Цена: ${current_cost} рублей.`);
    }))
        .fail(() => {
            alert('Не удалось изменить ' + id);
        });
});
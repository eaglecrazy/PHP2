//удаление элемента
$('.cart-item-cross').click((e) => {
    const id = e.target.id.replace('cross-', '');
    $.get(`../server/cart-edit-delete-item.php?id=${id}`, ((answer) => {
        $('#' + id).remove();
        const result = JSON.parse(answer);
        const total_count = result['total_count'];
        const total_cost = result['total_cost'];
        $('.cart-info-quantity').text(total_count + ' шт.');
        $('.cart-info-price').text(total_cost + ' руб.');

        //если удалили последний товар в корзине, то нужно убрать кнопку "оформить заказ"
        if(!total_count)
            $('.cart-issue-button').remove();

    }))
    .fail(() => {
        alert('Не удалось удалить ' + id);
    });
});


//изменение количества
$('.cart-item-quantity').change((e) => {
    const id = e.target.id.replace('input-', '');
    const count = e.target.value;
    $.get(`../server/cart-edit-delete-item.php?id=${id}&count=${count}`, ((answer) => {
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
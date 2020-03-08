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

//изменение количества
$('.cart-item-quantity').change((e) => {
    const id = e.target.id.replace('input-', '');
    if(parseInt(e.target.value) <= 0) {
        e.target.value = 1;
    }
    if(parseInt(e.target.value) >= 100) {
        e.target.value = 99;
    }
    const count = e.target.value;

    data = {
        'asAjax': true,
        'path': 'cart/edit',
        'id': id,
        'count' : count
    };

    $.ajax({
        url: 'index.php?cart/edit',
        type: 'GET',
        dataType: 'text',
        data: data,
        success: (answer) => {
            const result = JSON.parse(answer);
            const total_count = result['total_count'];
            const total_cost = result['total_cost'];
            //изменим цену и количество по всей корзине
            $('.cart-info-quantity').text(total_count + ' шт.');
            $('.cart-info-price').text(total_cost + ' руб.');
            //изменим общую стоимость по предмету
            let costOne =  $(`#cost-${id}`).text();
            costOne = costOne.replace('Цена за штуку: ','');
            costOne = costOne.replace(' рублей.', '');
            costOne = parseInt(costOne);
            let newCost = count * costOne;

            $(`#total-cost-${id}`).text(`Общая цена: ${newCost} рублей.`);

        },
        fail: () => {alert('Не удалось удалить ' + id)}
    });
});
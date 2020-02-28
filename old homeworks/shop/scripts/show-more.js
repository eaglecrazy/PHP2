$('#show-more').click((e) => {
    let count = $('.goods-item').length;
    $.get(`../server/show-more.php?count=${count}`, (page) => {
        if(page === 'end'){
            $('.button-wrapper').remove();
        } else {
            $('.goods-list').append(page);
        }
    })
        .fail(() => {
            alert('Не удалось загрузить товары.');
        });

});

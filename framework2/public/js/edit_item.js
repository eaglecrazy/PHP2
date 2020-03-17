//флаги изменения значений
let nameChange = false;
let costChange = false;
let descriptionChange = false;
let photoChange = false;

const id = $('#id').val();
const name = $('#name');
const cost = $('#cost');
const description = $('#description');
const photo = $('#photo');

let data = new FormData();

name.change(() => {
    nameChange = true;
});
cost.change(() => {
    costChange = true;
});
description.change(() => {
    descriptionChange = true;
});
photo.change(() => {
    photoChange = true;
});

$('#submit').click((e) => {

    e.preventDefault();

    if(nameChange){
        if (noValidation(document.getElementById('name'), 'Нужно ввести наименование товара.'))
            return;
        data.set('name', name.val());
    }
    if(costChange){
        if (noValidationNumber(document.getElementById('cost'), 'Нужно ввести цену. Цена должна быть больше нуля.'))
            return;
        data.set('cost', cost.val());
    }
    if(descriptionChange){
        if (noValidation(document.getElementById('description'), 'Нужно ввести описание товара.'))
            return;
        data.set('description', description.val());
    }
    if(photoChange){
        if (noValidation(document.getElementById('photo'), 'Загрузите фото.'))
            return;
        data.set('photo', photo[0].files[0]);
    }

    data.set('asAjax', true);

    $.ajax({
        url: `index.php?path=admin_items/edit/${id}`,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,

        success: (answer) => {
            let result = JSON.parse(answer);
            $('.form-heading').text(`Товар ${name.val()} изменён.`);

            //если были ошибки, то покаем их в лейблах
            const lname = $('#l-name');
            const lcost = $('#l-cost');
            const ldesc = $('#l-description');
            const lphoto = $('#l-photo');

            if(result.content_data.name === -1){
                lname.text('Ошибка изменения наименования');
                lname.css('color', 'red');
            } else if (result.content_data.name === 1){
                lname.text('Наименование товара');
                lname.css('color', '#333333');
            }

            if(result.content_data.cost === -1){
                lcost.text('Ошибка изменения стоимости');
                lcost.css('color', 'red');
            } else if (result.content_data.cost === 1){
                lcost.text('Стоимость товара\n');
                lcost.css('color', '#333333');
            }

            if(result.content_data.description === -1){
                ldesc.text('Ошибка изменения описания');
                ldesc.css('color', 'red');
            } else if (result.content_data.description === 1){
                ldesc.text('Описание товара\n');
                ldesc.css('color', '#333333');
            }

            if(result.content_data.photo === -1){
                lphoto.text('Ошибка изменения фотографии');
                lphoto.css('color', 'red');
            } else if (result.content_data.photo !== 0){//в этом случае фоточка изменилась
                lphoto.text('Фотография товара');
                lphoto.css('color', '#333333');
                $('#item-photo').attr('src', `../templates/img/small/${result.content_data.photo}`);
            }

            //обнулим данные
            nameChange = false;
            costChange = false;
            descriptionChange = false;
            photoChange = false;
            data = new FormData();
        },
        fail: (answer) => {
            alert('Ошибка изменения товара.');
        },
    });
});


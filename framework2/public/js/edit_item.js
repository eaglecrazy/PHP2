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

const data = new FormData();

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
        if (noValidation(document.getElementById('name'), 'Нужно ввести наименование товара!'))
            return;
        data.set('name', name.val());
    }
    if(costChange){
        if (noValidationNumber(document.getElementById('cost'), 'Нужно ввести цену!'))
            return;
        data.set('cost', cost.val());
    }
    if(descriptionChange){
        if (noValidation(document.getElementById('description'), 'Нужно ввести описание товара!'))
            return;
        data.set('description', description.val());
    }
    if(photoChange){
        if (noValidation(document.getElementById('photo'), 'Загрузите фото!'))
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
            alert(result.content_data);
        },
        fail: (answer) => {
            console.log('f ' + answer);
        },
        complete: (answer, status) =>{
            console.log('c ' + answer + ' ' + status);
        }
    });
});


//флаги изменения значений
let nameChange = false;
let costChange = false;
let descriptionChange = false;
let photoChange = false;

const name = $('#name');
const cost = $('#cost');
const description = $('#description');
const photo = $('#photo');

const data = {
    name : '',
    cost : '',
    description : '',
    file : ''
}

name.change(()=>{ nameChange = true; });
cost.change(()=>{ costChange = true; });
description.change(()=>{ descriptionChange = true; });
photo.change(()=>{ photoChange = true; });

$('#submit').click((e)=>{

    e.preventDefault();

    if(nameChange){
        if (noValidation(document.getElementById('name'), 'Нужно ввести наименование товара!'))
            return;
        data.name = name.text();
    }
    if(costChange){
        if (noValidationNumber(document.getElementById('cost'), 'Нужно ввести цену!'))
            return;
        data.cost = cost.text();
    }
    if(descriptionChange){
        if (noValidation(document.getElementById('description'), 'Нужно ввести описание товара!'))
            return;
        data.description = description.text();
    }
    if(photoChange){
        if (noValidation(document.getElementById('photo'), 'Загрузите фото!'))
            return;
    }

    //https://webdevkin.ru/posts/raznoe/otpravka-fajlov-na-server-ajax
});


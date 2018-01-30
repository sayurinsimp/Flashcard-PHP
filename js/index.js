$deleteBtn = $('.card__delete');

$showFormBtn = $('.show-form');
$form = $('.form');
$formCancel = $('.form-cancel');

$deleteBtn.on('click', function(){
    console.log('delete clicked');
});

$showFormBtn.on('click', function(){
    $form.show();
});

$formCancel.on('click', function(){
    $(this).parent().hide();
});
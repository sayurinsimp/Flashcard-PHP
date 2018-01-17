const $card = $('.card');
const $cardBtn = $('.card__btn');
const $answer = $('.answer');
const $question = $('.question');
let showAnswer = false;

$answer.hide(); // hide card answers

$cardBtn.on('click', function(){
    const $cardClicked = $(this).parent().parent();
    const $btnClicked = $(this);
    const btnText = $(this).text();

    $cardClicked.toggleClass('showing_question');
    
    $(this).text(btnText === 'Show Answer' ? 'Show Question' : 'Show Answer');

    $cardClicked.hasClass('showing_question') ? showAndHideChild($btnClicked, $answer, $question) : showAndHideChild($btnClicked, $question, $answer);
})

function showAndHideChild(clicked, showElement, hideElement) {
    clicked.parent().find(showElement).show();
    clicked.parent().find(hideElement).hide();
}
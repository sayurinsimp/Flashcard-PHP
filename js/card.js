const $card = $('.card');
const $answer = $('.answer'); // Card answer
const $question = $('.question'); // Card question
const $cardEdit = $('.card__edit');
const $addCardBtn = $('.add-card');
const $addCardForm = $('.card:last-child');

$answer.hide();
$cardEdit.hide();

$card.on('click', function(e){
    // Don't toggle show/hide if edit clicked
    if ($(e.target).is('button')) {
        return;
    }
    const $cardClicked = $(this);
    const $cardQuestion = $(this).find($question);
    const $cardAnswer = $(this).find($answer);
    toggleElements($cardClicked, $cardQuestion, $cardAnswer);
});

/**
 * Toggle edit button on card
 */
$card.hover(function(){
    $(this).find($cardEdit).toggle();
});

$cardEdit.on('click', function(){
    const $clickedCard = $(this).parent();
    const $editCard = $(this).parent().next();
    $clickedCard.toggle();
    $editCard.toggle();
});

/**
 * Show form for adding card to set
 */
$addCardBtn.on('click', function(){
    $addCardForm.show();
    $(this).hide();
});

/**
 * Toggle hide and show elements
 * @param {Element} card = the card clicked
 * @param {Element} q = the question element
 * @param {Element} a = the answer element
 */
function toggleElements(card, q, a) {
    card.hasClass('show_answer') && (q.hide(), a.show()) || (q.show(), a.hide());
    card.toggleClass('show_answer');
}
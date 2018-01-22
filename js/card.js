const $card = $('.card');
const $answer = $('.answer');
const $question = $('.question');
const $cardEdit = $('.card__edit');

$answer.hide();
$cardEdit.hide();

$card.on('click', function(e){
    // Don't toggle show/hide if edit clicked
    if ($(e.target).is('a')) {
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
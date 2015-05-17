$(document).ready(function() {

    /**
     * OnClick listener for each character button
     */
    $('.character-button').on('click', function() {

        var strGuessedLetter = $(this).attr('value');

        guessLetterRequest(strGuessedLetter, $(this));
    });

    /**
     * OnClick listener for reveal answer button
     */
    $('#reveal-answer-button').on('click', function() {
        revealAnswer();

        $(this).hide(GAME_OVER_FADE);
    });

    initialiseComponents();
});

var arrImages          = new Array(),
    strHungManImageUrl = '/bundles/hangman/images/Hangman_9.png',
    SUCCESS_CODE       = 100,
    GAME_OVER_FADE     = 1000,
    IMAGE_FADE         = 500,
    IMAGE_CLASS_NAME   = 'stand-image',
    GAME_WON_MESSAGE   = "Congratulations, you found the word!",
    GAME_LOST_MESSAGE  = "Better luck next time!";

var objCurrentWord,
    objRemainingGuesses,
    objNextWordButton,
    objGameOverText,
    objCharacterButtons,
    objRevealAnswerButton,
    objStandImage;

preloadImages(
    "/bundles/hangman/images/Hangman_0.png",
    "/bundles/hangman/images/Hangman_1.png",
    "/bundles/hangman/images/Hangman_2.png",
    "/bundles/hangman/images/Hangman_3.png",
    "/bundles/hangman/images/Hangman_4.png",
    "/bundles/hangman/images/Hangman_5.png",
    "/bundles/hangman/images/Hangman_6.png",
    "/bundles/hangman/images/Hangman_7.png",
    "/bundles/hangman/images/Hangman_8.png",
    "/bundles/hangman/images/Hangman_9.png"
);



function initialiseComponents()
{
    objCurrentWord        = document.getElementById('current-word'),
    objRemainingGuesses   = document.getElementById('remaining-guesses'),
    objNextWordButton     = $('#next-word-button'),
    objGameOverText       = document.getElementById('game-over-text'),
    objCharacterButtons   = $('.character-button'),
    objRevealAnswerButton = $('#reveal-answer-button'),
    objStandImage         = $('img.stand-image');
}


/**
 * Preload all required images
 *
 * @return null
 */
function preloadImages()
{
    for (intIndex = 0; intIndex < preloadImages.arguments.length; intIndex++)
    {
        arrImages[intIndex]           = new Image();
        arrImages[intIndex].className = IMAGE_CLASS_NAME;
        arrImages[intIndex].src       = preloadImages.arguments[intIndex]
    }
}

/**
 * Retrieve and reveal the correct answer
 *
 * @return null
 */
function revealAnswer()
{
    $.post('/retrieveAnswer',
        function(objResponse){
            if(objResponse.intCode == SUCCESS_CODE && objResponse.bolSuccess)
                if (objResponse.strCurrentWord)
                    objCurrentWord.innerHTML = objResponse.strCurrentWord;
            else
                alert(objResponse.strError);
        }, "json");
}

/**
 * Perform AJAX request to guess a letter
 *
 * @param strGuessedLetter
 * @param objCharacterButton
 *
 * @return null|boolean
 */
function guessLetterRequest(strGuessedLetter, objCharacterButton)
{
    $.post('/guessLetter',
           {strGuessedLetter: strGuessedLetter},
           function(objResponse) {

                if(objResponse.intCode == SUCCESS_CODE && objResponse.bolSuccess)
                    return handleGuessResponse(objResponse, strGuessedLetter, objCharacterButton);
                else
                    alert(objResponse.strError);

           }, "json");
}

/**
 * Handle updating the UI upon receiving response from guessing letter
 *
 * @param objResponse
 * @param strGuessedLetter
 * @param objCharacterButton
 *
 * @return null|boolean
 */
function handleGuessResponse(objResponse, strGuessedLetter, objCharacterButton)
{
    objCharacterButton.attr('disabled', 'disabled');

    objRemainingGuesses.innerHTML = objResponse.intGuessesRemaining;

    if (!objResponse.bolCorrectGuess) {

        changeImage(objResponse.intGuessesTaken);

        if(objResponse.bolGameOver)
            gameOver(objResponse.bolGameWon);

        return false;
    }

    var strNewWord = recalculateWord(objCurrentWord.innerHTML,
                                     strGuessedLetter,
                                     objResponse.arrLetterPositions
    );

    objCurrentWord.innerHTML = strNewWord;

    if (objResponse.bolGameOver)
        gameOver(objResponse.bolGameOver);
}

/**
 * Change the image on an incorrect guess
 *
 * @param intGuessesTaken
 *
 * @return null
 */
function changeImage(intGuessesTaken)
{
    objStandImage = $('img.stand-image');

    if (objStandImage.attr('src') != strHungManImageUrl)
    {
        objStandImage.fadeOut(IMAGE_FADE, function () {
            var objNewContent = $(arrImages[intGuessesTaken]);

            $(this).replaceWith(objNewContent.hide());
            $(objNewContent).fadeIn(IMAGE_FADE);

        });
    }
}

/**
 * Handle showing relevant navigation and text once game
 * is complete
 *
 * @param bolGameWon
 *
 * @return null
 */
function gameOver(bolGameWon)
{
    if (bolGameWon)
    {
        objGameOverText.innerHTML = GAME_WON_MESSAGE;

        objNextWordButton.show(GAME_OVER_FADE);
        objCharacterButtons.attr('disabled', 'disabled');
    }
    else
    {
        objGameOverText.innerHTML = GAME_LOST_MESSAGE;

        objRevealAnswerButton.show(GAME_OVER_FADE);
        objNextWordButton.show(GAME_OVER_FADE);
        objCharacterButtons.attr('disabled', 'disabled');

    }
}
/**
 * Alter the displayed text and fill in the blanks with the guessed
 * letter
 *
 * @param strText
 * @param strGuessedLetter
 * @param arrLetterPositions
 *
 * @returns string
 */
function recalculateWord(strText, strGuessedLetter, arrLetterPositions)
{
    var strTrimmedText = $.trim(strText),
        arrWord        = strTrimmedText.split(/\s+/);

    for (intIndex = 0; intIndex < arrWord.length; intIndex++)
    {
        if (arrLetterPositions.indexOf(intIndex) != -1)
            arrWord[intIndex] = strGuessedLetter;
    }

    return arrWord.join(' ');
}
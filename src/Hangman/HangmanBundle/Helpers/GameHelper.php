<?php

namespace Hangman\HangmanBundle\Helpers;

use Hangman\HangmanBundle\Controller\BaseController;

/**
 * Class created to handle logic removed from game controller
 *
 * @package Hangman\HangmanBundle\Helpers
 */
class GameHelper
{
    /**
     * Compile AJAX response for guessing a word
     *
     * @param GameData $objGameData
     * @param string   $strGuessedLetter
     * @param array    $arrResponse
     *
     * @return array
     */
    public function compileGuessLetterResponse($objGameData, $strGuessedLetter, $arrResponse)
    {
        if ($strGuessedLetter == null || $strGuessedLetter == "")
        {
            return $arrResponse;
        }

        $arrLetterPositions = $objGameData->getGuessesRemaining() == 0
                                ? array()
                                : $objGameData->guessLetter($strGuessedLetter);

        $arrResponse['intCode']             = BaseController::SUCCESS_CODE;
        $arrResponse['bolSuccess']          = true;
        $arrResponse['intGuessesRemaining'] = $objGameData->getGuessesRemaining();
        $arrResponse['intGuessesTaken']     = $objGameData->getGuessesTaken();
        $arrResponse['bolCorrectGuess']     = !empty($arrLetterPositions);
        $arrResponse['arrLetterPositions']  = $arrLetterPositions;

        $bolWholeWordGuessed = $objGameData->guessedWholeWord();

        if ($objGameData->getGuessesRemaining() == 0 || ($objGameData->getGuessesRemaining() >0 && $bolWholeWordGuessed))
        {
            $arrResponse['bolGameOver'] = true;
            $arrResponse['bolGameWon']  = $bolWholeWordGuessed;
        }

        return $arrResponse;
    }
}
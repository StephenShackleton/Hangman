<?php

namespace Hangman\HangmanBundle\Controller;

use Hangman\HangmanBundle\Helpers\GameHelper;
use Hangman\HangmanBundle\Helpers\GameData;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session;

/**
 * Controller created to handle all requests regarding game play
 * and navigation through the game
 *
 * @package Hangman\HangmanBundle\Controller
 */
class GameController extends BaseController
{
    const COULDNT_RETRIEVE_ANSWER = "Action could not be performed as answer could not be retrieved.";
    const COULDNT_GUESS_LETTER    = "Unfortunately an error occured and the letter could not be guessed.";
    const DEFAULT_IMAGE_URL       = "/bundles/hangman/images/Hangman_0.png";

    /**
     * Handle request to start a completely new game
     *
     * @return Response
     */
    public function indexAction()
    {
        $objGameData     = new GameData();
        $arrTemplateData = array('arrLetters'          => $objGameData->getPossibleLetters(),
                                 'strWord'             => $objGameData->getCurrentWord(),
                                 'intGuessesRemaining' => $objGameData->getGuessesRemaining(),
                                 'intGamesPlayed'      => $objGameData->getGamesPlayed(),
                                 'intGamesWon'         => $objGameData->getGamesWon()
        );

        $this->setSessionGameData($objGameData);

        return $this->render('HangmanBundle:Game:index.html.twig', $arrTemplateData);
    }

    /**
     * Handle AJAX request for retrieving current answer
     *
     * @return Response
     */
    public function retrieveAnswerAction()
    {
        $arrResponse = array('intCode'    => BaseController::FAIL_CODE,
                             'bolSuccess' => false,
                             'strError'   => self::COULDNT_RETRIEVE_ANSWER
        );

        try
        {
            $objGameData = $this->getSessionGameData();
        }
        catch (RuntimeException $objException)
        {
            return new Response(json_encode($arrResponse));
        }

        $strCurrentWord = $objGameData->getCurrentWord();

        if (is_null($strCurrentWord) || $strCurrentWord == "")
        {
            return new Response(json_encode($arrResponse));
        }

        return new Response(json_encode(array('intCode'        => BaseController::SUCCESS_CODE,
                                              'bolSuccess'     => true,
                                              'strCurrentWord' => $objGameData->getCurrentWord())
        ));
    }

    /**
     * Handle request to start a new word
     *
     * @return Response
     */
    public function nextWordAction()
    {
        try
        {
            $objGameData = $this->getSessionGameData();
        }
        catch (RuntimeException $objException)
        {
            return $this->redirectToRoute('welcome');
        }

        if ($objGameData->nextWord())
        {
            return $this->render('HangmanBundle:Game:index.html.twig', array('arrLetters'          => $objGameData->getPossibleLetters(),
                                                                             'strWord'             => $objGameData->getCurrentWord(),
                                                                             'intGuessesRemaining' => $objGameData->getGuessesRemaining(),
                                                                             'intGamesPlayed'      => $objGameData->getGamesPlayed(),
                                                                             'intGamesWon'         => $objGameData->getGamesWon()
            ));
        }


        return $this->render('HangmanBundle:Game:end_game.html.twig', array('intGamesPlayed' => $objGameData->getGamesPlayed(),
                                                                            'intGamesWon'    => $objGameData->getGamesWon()

        ));
    }

    /**
     * Handle AJAX request for guessing a letter on the current game
     *
     * @param Request $objRequest
     *
     * @return Response
     */
    public function guessLetterAction(Request $objRequest)
    {
        $arrResponse = array('intCode'    => BaseController::FAIL_CODE,
                             'bolSuccess' => false,
                             'strError'   => self::COULDNT_GUESS_LETTER
        );

        try
        {
            $objGameData = $this->getSessionGameData();
        }
        catch (RuntimeException $objException)
        {
            return new Response(json_encode($arrResponse));
        }

        $objGameHelper    = new GameHelper();
        $strGuessedLetter = $objRequest->request->get('strGuessedLetter');
        $arrResponse      = $objGameHelper->compileGuessLetterResponse($objGameData, $strGuessedLetter, $arrResponse);

        return new Response(json_encode($arrResponse));
    }
}
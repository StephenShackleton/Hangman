<?php
namespace Hangman\HangmanBundle\Controller;

use Hangman\HangmanBundle\Helpers\GameData;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class created as a base controller for other controllers within
 * project, containing generic methods useful to other controllers
 *
 * @package Hangman\HangmanBundle\Controller
 */
class BaseController extends Controller
{
    const FAIL_CODE             = 500;
    const GAME_DATA_UNAVAILABLE = 'Session Game Data not available';
    const SESSION_GAME_DATA     = 'GAME_DATA';
    const SUCCESS_CODE          = 100;

    /**
     * Get the current session
     *
     * @return Session
     */
    protected function getSession()
    {
        return $this->get('session');
    }

    /**
     * Set the user's game data object in the current
     * session
     *
     * @param GameData $objGameData
     *
     * @return null
     */
    protected function setSessionGameData(GameData $objGameData)
    {
        $this->getSession()->set(self::SESSION_GAME_DATA, $objGameData);
    }

    /**
     * Get the user's game data object from the current
     * session
     *
     * @return GameData|null
     *
     * @throws RuntimeException
     */
    protected function getSessionGameData()
    {
        $objGameData = $this->getSession()->get(self::SESSION_GAME_DATA);

        if (is_null($objGameData))
        {
            throw new RuntimeException(self::GAME_DATA_UNAVAILABLE);
        }

        return $objGameData;
    }
}
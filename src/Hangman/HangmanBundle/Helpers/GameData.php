<?php

namespace Hangman\HangmanBundle\Helpers;

/**
 * Class created to represent game data for a current playing
 * session.
 *
 * @package Hangman\HangmanBundle\Helpers
 */
class GameData
{
    const MAXIMUM_GUESSES       = 9;
    const STARTING_NUMBER_GAMES = 1;

    private $arrWordSet;
    private $arrGuessedWords;

    private $strCurrentWord;
    private $arrPossibleLetters;
    private $arrGuessedLetters;

    private $intGamesPlayed;
    private $intGamesWon;

    private $intMaximumGuesses;
    private $intIncorrectGuessesMade;

    /**
     * Create new instance of game data and initialise
     * all variables
     */
    function __construct()
    {
        $this->arrWordSet = Dictionary::getFullWordSet();

        $intRandomIndex       = array_rand($this->arrWordSet);
        $this->strCurrentWord = $this->arrWordSet[$intRandomIndex];

        $this->arrGuessedWords = array();
        array_push($this->arrGuessedWords, $this->strCurrentWord);

        $this->arrPossibleLetters      = Dictionary::getCharacterSet();
        $this->arrGuessedLetters       = array();
        $this->intGamesPlayed          = self::STARTING_NUMBER_GAMES;
        $this->intGamesWon             = 0;
        $this->intMaximumGuesses       = self::MAXIMUM_GUESSES;
        $this->intIncorrectGuessesMade = 0;
    }

    /**
     * Update variables for playing the next word and return
     * counting variables, such as guesses made, to initiale
     * state
     *
     * @return boolean
     */
    public function nextWord()
    {
        $arrWords = array_diff($this->arrWordSet, $this->arrGuessedWords);

        if (empty($arrWords) || $arrWords == null)
        {
            return false;
        }

        $this->intGamesPlayed++;

        $intRandomIndex       = array_rand($arrWords);
        $this->strCurrentWord = $this->arrWordSet[$intRandomIndex];

        array_push($this->arrGuessedWords, $this->strCurrentWord);

        $this->arrGuessedLetters       = array();
        $this->intIncorrectGuessesMade = 0;

        return true;
    }

    /**
     * Update variables to show that the user has guessed a particular
     * letter
     *
     * @param string $strGuessedLetter
     *
     * @return array
     */
    public function guessLetter($strGuessedLetter)
    {
        array_push($this->arrGuessedLetters, $strGuessedLetter);

        $arrLetterPositions = Dictionary::getWordPositions($this->strCurrentWord, $strGuessedLetter);

        if (empty($arrLetterPositions))
        {
            $this->intIncorrectGuessesMade++;
        }

        return $arrLetterPositions;
    }

    /**
     * Check whether the user has guessed the entire word
     *
     * @return boolean
     */
    public function guessedWholeWord()
    {
        $arrCurrentWord         = str_split(preg_replace('{(.)\1+}', '$1', $this->strCurrentWord));
        $arrLowerCurrentWord    = array_map('strtolower', $arrCurrentWord);
        $arrLowerGuessedLetters = array_map('strtolower', $this->arrGuessedLetters);

        $bolGuessedWholeWord = count(array_intersect($arrLowerCurrentWord, $arrLowerGuessedLetters )) == count($arrCurrentWord);

        if($bolGuessedWholeWord)
        {
            $this->incrementGamesWon();
        }

        return $bolGuessedWholeWord;
    }

    /**
     * Retrieve the number of guesses remaining for the user
     *
     * @return int
     */
    public function getGuessesRemaining()
    {
        return $this->intMaximumGuesses - $this->intIncorrectGuessesMade;
    }

    /**
     * Retrieve array of letters available to the user
     *
     * @return array
     */
    public function getPossibleLetters()
    {
        return $this->arrPossibleLetters;
    }

    /**
     * Retrieve the current word that the user is attempting
     *
     * @return string
     */
    public function getCurrentWord()
    {
        return $this->strCurrentWord;
    }

    /**
     * Return the number of games played
     *
     * @return int
     */
    public function getGamesPlayed()
    {
        return $this->intGamesPlayed;
    }

    /**
     * Retrieve the number of games won
     *
     * @return int
     */
    public function getGamesWon()
    {
        return $this->intGamesWon;
    }

    /**
     * Increment value containing number of games won
     *
     * @return null
     */
    public function incrementGamesWon()
    {
        $this->intGamesWon++;
    }

    /**
     * Return the number of guesses taken
     *
     * @return int
     */
    public function getGuessesTaken()
    {
        return $this->intIncorrectGuessesMade;
    }
}
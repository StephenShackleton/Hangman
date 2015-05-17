<?php
namespace Hangman\HangmanBundle\Helpers;

/**
 * Class created to store data regarding word set and
 * character range for game
 *
 * @package Hangman\HangmanBundle\Helpers
 */
class Dictionary
{
    /**
     * Retrieve the word complete word set available
     *
     * @return array
     */
    public static final function getFullWordSet()
    {
        return array('Programming', 'Television', 'Garden', 'Banana', 'Computer', 'Christmas', 'Zebra');
    }

    /**
     * Retrieve the complete set of characters available
     *
     * @return array
     */
    public static final function getCharacterSet()
    {
        return range('A', 'Z');
    }

    /**
     * Retrieve an array of index's within the word where the
     * specified character is
     *
     * @param string $strWord
     * @param string $strCharacter
     *
     * @return array
     */
    public static final function getWordPositions($strWord, $strCharacter)
    {
        $intLastPosition = 0;
        $arrPositions    = array();

        while (($intLastPosition = stripos($strWord, $strCharacter, $intLastPosition)) !== false)
        {
            $arrPositions[]  = $intLastPosition;
            $intLastPosition = $intLastPosition + strlen($strCharacter);
        }

        return $arrPositions;
    }
}
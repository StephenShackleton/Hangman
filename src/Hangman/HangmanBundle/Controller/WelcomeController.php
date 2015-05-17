<?php

namespace Hangman\HangmanBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class created to handle requests regarding requests for the
 * home page
 *
 * @package Hangman\HangmanBundle\Controller
 */
class WelcomeController extends BaseController
{
    /**
     * Handle home page request rendering welcome page
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('HangmanBundle:Welcome:index.html.twig');
    }
}

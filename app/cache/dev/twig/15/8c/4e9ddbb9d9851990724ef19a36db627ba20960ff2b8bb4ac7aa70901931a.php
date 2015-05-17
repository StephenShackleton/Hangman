<?php

/* HangmanBundle:Game:end_game.html.twig */
class __TwigTemplate_158c4e9ddbb9d9851990724ef19a36db627ba20960ff2b8bb4ac7aa70901931a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("HangmanBundle::layout.html.twig", "HangmanBundle:Game:end_game.html.twig", 1);
        $this->blocks = array(
            'content_header' => array($this, 'block_content_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "HangmanBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content_header($context, array $blocks = array())
    {
        echo "";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <h1>
        Play Hangman!
    </h1>

    <div class=\"end-game\">

        <p>No more words to play! Sorry...</p>

        <div>
            ";
        // line 15
        if (array_key_exists("intGamesPlayed", $context)) {
            // line 16
            echo "                <p>Games played: </p> <p>";
            echo twig_escape_filter($this->env, (isset($context["intGamesPlayed"]) ? $context["intGamesPlayed"] : $this->getContext($context, "intGamesPlayed")), "html", null, true);
            echo "</p>
            ";
        }
        // line 18
        echo "
            ";
        // line 19
        if (array_key_exists("intGamesWon", $context)) {
            // line 20
            echo "                <p>Games won: </p> <p>";
            echo twig_escape_filter($this->env, (isset($context["intGamesWon"]) ? $context["intGamesWon"] : $this->getContext($context, "intGamesWon")), "html", null, true);
            echo "</p>
            ";
        }
        // line 22
        echo "        </div>

        <a href=\"";
        // line 24
        echo $this->env->getExtension('routing')->getPath("welcome");
        echo "\">
            <button>Start New Game</button>
        </a>

    </div>
";
    }

    public function getTemplateName()
    {
        return "HangmanBundle:Game:end_game.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 24,  68 => 22,  62 => 20,  60 => 19,  57 => 18,  51 => 16,  49 => 15,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }
}

<?php

/* HangmanBundle:Game:index.html.twig */
class __TwigTemplate_3ddd5d79e320af5bd0412ddd4d822bf3bb3e8d00c1026b537db2bef272bfa250 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("HangmanBundle::layout.html.twig", "HangmanBundle:Game:index.html.twig", 1);
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
        echo "
    <h1>
        Play Hangman!
    </h1>

    <div class=\"game-body\">

        <div class=\"game-stats\">
            ";
        // line 14
        if (array_key_exists("intGamesPlayed", $context)) {
            // line 15
            echo "                <p>Games played: </p> <p>";
            echo twig_escape_filter($this->env, (isset($context["intGamesPlayed"]) ? $context["intGamesPlayed"] : $this->getContext($context, "intGamesPlayed")), "html", null, true);
            echo "</p>
            ";
        }
        // line 17
        echo "
            ";
        // line 18
        if (array_key_exists("intGamesWon", $context)) {
            // line 19
            echo "                <p>Games won: </p><p>";
            echo twig_escape_filter($this->env, (isset($context["intGamesWon"]) ? $context["intGamesWon"] : $this->getContext($context, "intGamesWon")), "html", null, true);
            echo "</p>
            ";
        }
        // line 21
        echo "        </div>

        <div class=\"game-stats\">
            ";
        // line 24
        if (array_key_exists("intGuessesRemaining", $context)) {
            // line 25
            echo "                <p>Guesses remaining: </p> <p id=\"remaining-guesses\">";
            echo twig_escape_filter($this->env, (isset($context["intGuessesRemaining"]) ? $context["intGuessesRemaining"] : $this->getContext($context, "intGuessesRemaining")), "html", null, true);
            echo "</p>
            ";
        }
        // line 27
        echo "        </div>

        <div id=\"image-container\">
            ";
        // line 30
        $context["strDefaultImagePath"] = twig_constant("Hangman\\HangmanBundle\\Controller\\GameController::DEFAULT_IMAGE_URL");
        // line 31
        echo "
            <img class=\"stand-image\" src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((isset($context["strDefaultImagePath"]) ? $context["strDefaultImagePath"] : $this->getContext($context, "strDefaultImagePath"))), "html", null, true);
        echo "\" alt=\"Hangman Stand\" />

        </div>


        ";
        // line 37
        if (array_key_exists("strWord", $context)) {
            // line 38
            echo "            ";
            $context["arrCharacters"] = twig_split_filter($this->env, (isset($context["strWord"]) ? $context["strWord"] : $this->getContext($context, "strWord")), "");
            // line 39
            echo "            <div >
                <p id=\"current-word\">";
            // line 40
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["arrCharacters"]) ? $context["arrCharacters"] : $this->getContext($context, "arrCharacters")));
            foreach ($context['_seq'] as $context["_key"] => $context["strCharacter"]) {
                echo " _ ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['strCharacter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</p>
            </div>
        ";
        }
        // line 43
        echo "
        <div class=\"game-over-buttons\">

            <p id=\"game-over-text\"></p>
            <br/>

            <button id=\"reveal-answer-button\" hidden>
                Reveal Answer
            </button>
            <a href=\"";
        // line 52
        echo $this->env->getExtension('routing')->getPath("next_word");
        echo "\">
                <button id=\"next-word-button\" hidden>
                    Next Word
                </button>
            </a>

        </div>

        <div class=\"letter-selection\">

            ";
        // line 62
        if (array_key_exists("arrLetters", $context)) {
            // line 63
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["arrLetters"]) ? $context["arrLetters"] : $this->getContext($context, "arrLetters")));
            foreach ($context['_seq'] as $context["_key"] => $context["strLetter"]) {
                // line 64
                echo "
                    <button class=\"character-button\" value=\"";
                // line 65
                echo twig_escape_filter($this->env, $context["strLetter"], "html", null, true);
                echo "\">
                        ";
                // line 66
                echo twig_escape_filter($this->env, $context["strLetter"], "html", null, true);
                echo "
                    </button>

                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['strLetter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "            ";
        }
        // line 71
        echo "
        </div>

        <div class=\"new-game-container\">
            <a href=\"";
        // line 75
        echo $this->env->getExtension('routing')->getPath("welcome");
        echo "\">
                <button class=\"new-game-button\">
                    Start New Game
                </button>
            </a>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "HangmanBundle:Game:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 75,  170 => 71,  167 => 70,  157 => 66,  153 => 65,  150 => 64,  145 => 63,  143 => 62,  130 => 52,  119 => 43,  106 => 40,  103 => 39,  100 => 38,  98 => 37,  90 => 32,  87 => 31,  85 => 30,  80 => 27,  74 => 25,  72 => 24,  67 => 21,  61 => 19,  59 => 18,  56 => 17,  50 => 15,  48 => 14,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }
}

<?php

/* HangmanBundle:Welcome:index.html.twig */
class __TwigTemplate_6505b04b18442fc1bd2f57da8e9c39f85e66b32d468e5e2d76b26a4db2b9e159 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("HangmanBundle::layout.html.twig", "HangmanBundle:Welcome:index.html.twig", 1);
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

    <div class=\"welcome\">

        <div >
            <img class=\"welcome-image\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/hangman/images/Hangman_9.png"), "html", null, true);
        echo "\" alt=\"Hangman Stand\" />
        </div>

        <form action=\"";
        // line 16
        echo $this->env->getExtension('routing')->getPath("play");
        echo "\">
            <input type=\"submit\" class=\"play-button\" value=\"Play\">
        </form>

    </div>
";
    }

    public function getTemplateName()
    {
        return "HangmanBundle:Welcome:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 16,  47 => 13,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }
}

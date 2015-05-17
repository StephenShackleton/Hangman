<?php

/* HangmanBundle::layout.html.twig */
class __TwigTemplate_5e4a11ee690fefcfeab4d2504063c232cea299aa614303d5510d3d601b9c675a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'content_header' => array($this, 'block_content_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('head', $context, $blocks);
        // line 6
        echo "
";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        // line 8
        echo "
";
        // line 9
        $this->displayBlock('body', $context, $blocks);
    }

    // line 1
    public function block_head($context, array $blocks = array())
    {
        // line 2
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/hangman/css/styling.css"), "html", null, true);
        echo "\" />
    <script src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/hangman/js/jquery-2.1.4.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/hangman/js/GameControls.js"), "html", null, true);
        echo "\"></script>
";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        echo "";
    }

    // line 9
    public function block_body($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 11
            echo "        <div class=\"flash-message\">
            <em>Notice</em>: ";
            // line 12
            echo twig_escape_filter($this->env, $context["flashMessage"], "html", null, true);
            echo "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "
    ";
        // line 16
        $this->displayBlock('content_header', $context, $blocks);
        // line 17
        echo "
    <div class=\"block\">
        ";
        // line 19
        $this->displayBlock('content', $context, $blocks);
        // line 20
        echo "    </div>
";
    }

    // line 16
    public function block_content_header($context, array $blocks = array())
    {
        echo " ";
    }

    // line 19
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "HangmanBundle::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  104 => 19,  98 => 16,  93 => 20,  91 => 19,  87 => 17,  85 => 16,  82 => 15,  73 => 12,  70 => 11,  65 => 10,  62 => 9,  56 => 7,  50 => 4,  46 => 3,  41 => 2,  38 => 1,  34 => 9,  31 => 8,  29 => 7,  26 => 6,  24 => 1,);
    }
}

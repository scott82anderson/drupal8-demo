<?php

/* modules/scotts_module/templates/hello.html.twig */
class __TwigTemplate_5c74f2eb65d3291723e7a3e51d85c0073c878b0ca22f9878ffd97bb7de032b94 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"hello-message\">
    <h1>Hello ";
        // line 2
        echo twig_drupal_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "!</h1>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/scotts_module/templates/hello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }
}

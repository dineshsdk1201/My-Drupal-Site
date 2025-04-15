<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* core/themes/olivero/templates/maintenance-page.html.twig */
class __TwigTemplate_0323c14f0db2562983e83ce2224d887d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 11
        echo "
<div id=\"page-wrapper\" class=\"page-wrapper\">
  <div id=\"page\">

    <header id=\"header\" class=\"site-header\" role=\"banner\" data-once=\"navigation\">
      <div class=\"site-header__fixable\">
        <div class=\"site-header__initial\">
        </div>
        <div id=\"site-header__inner\" class=\"site-header__inner\">
          <div class=\"container site-header__inner__container\">
            <div class=\"site-branding block block-system block-system-branding-block\">
              <div class=\"site-branding__inner\">
                <div class=\"site-branding__text\">
                  <div class=\"site-branding__name\">
                    ";
        // line 25
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_name"] ?? null), 25, $this->source), "html", null, true);
        echo "
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div id=\"main-wrapper\" class=\"layout-main-wrapper layout-container\">
      <div id=\"main\" class=\"layout-main\">
        <div class=\"main-content\">
          <a id=\"main-content\" tabindex=\"-1\"></a>
          <div class=\"main-content__container container\">
            ";
        // line 40
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
        echo "
            <main role=\"main\">
              <div class=\"region region--content-above grid-full layout--pass--content-medium\">
                ";
        // line 43
        if (($context["title"] ?? null)) {
            // line 44
            echo "                  <h1 class=\"title\" id=\"page-title\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 44, $this->source), "html", null, true);
            echo "</h1>
                ";
        }
        // line 46
        echo "              </div>
              <div class=\"region region--content grid-full layout--pass--content-medium\" id=\"content\">
                <div id=\"block-olivero-content\" class=\"block block-system block-system-main-block text-content\">
                  ";
        // line 49
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 49), 49, $this->source), "html", null, true);
        echo "

                  ";
        // line 51
        $this->loadTemplate("@olivero/../images/site-under-maintenance-icon.svg", "core/themes/olivero/templates/maintenance-page.html.twig", 51)->display($context);
        // line 52
        echo "                </div>
              </div>
            </main>
          </div>
        </div>
        <div class=\"social-bar\">
        </div>
      </div>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/olivero/templates/maintenance-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 52,  97 => 51,  92 => 49,  87 => 46,  81 => 44,  79 => 43,  73 => 40,  55 => 25,  39 => 11,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/olivero/templates/maintenance-page.html.twig", "C:\\xampp\\htdocs\\tasty\\core\\themes\\olivero\\templates\\maintenance-page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 43, "include" => 51);
        static $filters = array("escape" => 25);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'include'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}

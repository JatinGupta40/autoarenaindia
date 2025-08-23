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

/* core/modules/layout_discovery/layouts/threecol_25_50_25/layout--threecol-25-50-25.html.twig */
class __TwigTemplate_144090ef5aa758d88c77a2d2cf2024f6bf774fec412d70d792f8c45431ba4b28 extends \Twig\Template
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
        // line 17
        $context["classes"] = [0 => "layout", 1 => "layout--threecol-25-50-25"];
        // line 22
        if (($context["content"] ?? null)) {
            // line 23
            echo "  <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 23), 23, $this->source), "html", null, true);
            echo ">
    ";
            // line 24
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "top", [], "any", false, false, true, 24)) {
                // line 25
                echo "      <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "top", [], "any", false, false, true, 25), "addClass", [0 => "layout__region", 1 => "layout__region--top"], "method", false, false, true, 25), 25, $this->source), "html", null, true);
                echo ">
        ";
                // line 26
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "top", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 29
            echo "
    ";
            // line 30
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "first", [], "any", false, false, true, 30)) {
                // line 31
                echo "      <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "first", [], "any", false, false, true, 31), "addClass", [0 => "layout__region", 1 => "layout__region--first"], "method", false, false, true, 31), 31, $this->source), "html", null, true);
                echo ">
        ";
                // line 32
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "first", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 35
            echo "
    ";
            // line 36
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "second", [], "any", false, false, true, 36)) {
                // line 37
                echo "      <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "second", [], "any", false, false, true, 37), "addClass", [0 => "layout__region", 1 => "layout__region--second"], "method", false, false, true, 37), 37, $this->source), "html", null, true);
                echo ">
        ";
                // line 38
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "second", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 41
            echo "
    ";
            // line 42
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "third", [], "any", false, false, true, 42)) {
                // line 43
                echo "      <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "third", [], "any", false, false, true, 43), "addClass", [0 => "layout__region", 1 => "layout__region--third"], "method", false, false, true, 43), 43, $this->source), "html", null, true);
                echo ">
        ";
                // line 44
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "third", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 47
            echo "
    ";
            // line 48
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "bottom", [], "any", false, false, true, 48)) {
                // line 49
                echo "      <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "bottom", [], "any", false, false, true, 49), "addClass", [0 => "layout__region", 1 => "layout__region--bottom"], "method", false, false, true, 49), 49, $this->source), "html", null, true);
                echo ">
        ";
                // line 50
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "bottom", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 53
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/layout_discovery/layouts/threecol_25_50_25/layout--threecol-25-50-25.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 53,  119 => 50,  114 => 49,  112 => 48,  109 => 47,  103 => 44,  98 => 43,  96 => 42,  93 => 41,  87 => 38,  82 => 37,  80 => 36,  77 => 35,  71 => 32,  66 => 31,  64 => 30,  61 => 29,  55 => 26,  50 => 25,  48 => 24,  43 => 23,  41 => 22,  39 => 17,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for a three column layout.
 *
 * This template provides a three column 25%-50%-25% display layout, with
 * additional areas for the top and the bottom.
 *
 * Available variables:
 * - content: The content for this layout.
 * - attributes: HTML attributes for the layout <div>.
 *
 * @ingroup themeable
 */
#}
{%
  set classes = [
    'layout',
    'layout--threecol-25-50-25',
  ]
%}
{% if content %}
  <div{{ attributes.addClass(classes) }}>
    {% if content.top %}
      <div {{ region_attributes.top.addClass('layout__region', 'layout__region--top') }}>
        {{ content.top }}
      </div>
    {% endif %}

    {% if content.first %}
      <div {{ region_attributes.first.addClass('layout__region', 'layout__region--first') }}>
        {{ content.first }}
      </div>
    {% endif %}

    {% if content.second %}
      <div {{ region_attributes.second.addClass('layout__region', 'layout__region--second') }}>
        {{ content.second }}
      </div>
    {% endif %}

    {% if content.third %}
      <div {{ region_attributes.third.addClass('layout__region', 'layout__region--third') }}>
        {{ content.third }}
      </div>
    {% endif %}

    {% if content.bottom %}
      <div {{ region_attributes.bottom.addClass('layout__region', 'layout__region--bottom') }}>
        {{ content.bottom }}
      </div>
    {% endif %}
  </div>
{% endif %}
", "core/modules/layout_discovery/layouts/threecol_25_50_25/layout--threecol-25-50-25.html.twig", "/var/www/html/web/core/modules/layout_discovery/layouts/threecol_25_50_25/layout--threecol-25-50-25.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 17, "if" => 22);
        static $filters = array("escape" => 23);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
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

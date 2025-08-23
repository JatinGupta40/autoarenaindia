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

/* themes/custom/autoarenaindia/templates/page.html.twig */
class __TwigTemplate_a577ac40f3a5a662205b729c81d3091de874a3c823a5f472af19794c081a2563 extends \Twig\Template
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
        // line 53
        echo "
<header class=\"header\">
  <div class=\"header-logo\">
    ";
        // line 56
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_logo", [], "any", false, false, true, 56), 56, $this->source), "html", null, true);
        echo "
  </div>  
  ";
        // line 58
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_menu_search", [], "any", false, false, true, 58)) {
            // line 59
            echo "    <div class=\"header-menu-search\">
      ";
            // line 60
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_menu_search", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
            echo "
    </div>  
  ";
        }
        // line 63
        echo "  ";
        // line 64
        echo "    <div class=\"header-login\">
      ";
        // line 65
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_login", [], "any", false, false, true, 65), 65, $this->source), "html", null, true);
        echo "
    </div>  
  ";
        // line 68
        echo "</header>
    ";
        // line 70
        echo "    <div class=\"hamburgersection\">
      ";
        // line 71
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hamburger", [], "any", false, false, true, 71), 71, $this->source), "html", null, true);
        echo "
    </div>

  ";
        // line 75
        echo "  
  <main role=\"main\">
    <a id=\"main-content\" tabindex=\"-1\"></a> ";
        // line 78
        echo "
    ";
        // line 79
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "type_of_cars", [], "any", false, false, true, 79)) {
            // line 80
            echo "      <div class=\"type_of_cars\">
        ";
            // line 81
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "type_of_cars", [], "any", false, false, true, 81), 81, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 84
        echo "
  </main>

  ";
        // line 87
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 87)) {
            // line 88
            echo "    <footer role=\"contentinfo\">
      ";
            // line 89
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 89), 89, $this->source), "html", null, true);
            echo "
      ";
            // line 91
            echo "      <div class=\"footerlower\">
        ";
            // line 93
            echo "        <div class=\"socialiconmobile\">
          ";
            // line 94
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_social_icon", [], "any", false, false, true, 94), 94, $this->source), "html", null, true);
            echo "
        </div>
        
        <div class=\"footer_legal_section\">
          ";
            // line 99
            echo "              <div class=\"branding\">
                <a href=\"";
            // line 100
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
            echo "\" rel=\"home\">
                  <img class=\"footer_logo\" src=\"themes/custom/foxnews/assets/images/logo/fox-news-footer-logo-square.svg\" />
                </a>
              </div>
              ";
            // line 105
            echo "              <div class=\"legal\">
                ";
            // line 106
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_legal", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo "
                ";
            // line 107
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_legal_text", [], "any", false, false, true, 107), 107, $this->source), "html", null, true);
            echo "
              </div>
              ";
            // line 110
            echo "              <div class=\"socialiconlaptop\">
                ";
            // line 111
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_social_icon", [], "any", false, false, true, 111), 111, $this->source), "html", null, true);
            echo "
              </div>
        </div>
      </div>
    </footer>
  ";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/autoarenaindia/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 111,  149 => 110,  144 => 107,  140 => 106,  137 => 105,  130 => 100,  127 => 99,  120 => 94,  117 => 93,  114 => 91,  110 => 89,  107 => 88,  105 => 87,  100 => 84,  94 => 81,  91 => 80,  89 => 79,  86 => 78,  82 => 75,  76 => 71,  73 => 70,  70 => 68,  65 => 65,  62 => 64,  60 => 63,  54 => 60,  51 => 59,  49 => 58,  44 => 56,  39 => 53,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Bartik's theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.highlighted: Items for the highlighted region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.featured_top: Items for the featured top region.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.featured_bottom_first: Items for the first featured bottom region.
 * - page.featured_bottom_second: Items for the second featured bottom region.
 * - page.featured_bottom_third: Items for the third featured bottom region.
 * - page.footer_first: Items for the first footer column.
 * - page.footer_second: Items for the second footer column.
 * - page.footer_third: Items for the third footer column.
 * - page.footer_fourth: Items for the fourth footer column.
 * - page.footer_fifth: Items for the fifth footer column.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}

<header class=\"header\">
  <div class=\"header-logo\">
    {{ page.header_logo }}
  </div>  
  {% if page.header_menu_search %}
    <div class=\"header-menu-search\">
      {{ page.header_menu_search }}
    </div>  
  {% endif %}
  {# {% if page.header_login %} #}
    <div class=\"header-login\">
      {{ page.header_login }}
    </div>  
  {# {% endif %} #}
</header>
    {# Search Menu for Hamburger Menu #}
    <div class=\"hamburgersection\">
      {{ page.hamburger }}
    </div>

  {# Top Banner #}
  
  <main role=\"main\">
    <a id=\"main-content\" tabindex=\"-1\"></a> {# link is in html.html.twig #}

    {% if page.type_of_cars %}
      <div class=\"type_of_cars\">
        {{ page.type_of_cars }}
      </div>
    {% endif %}

  </main>

  {% if page.footer %}
    <footer role=\"contentinfo\">
      {{ page.footer }}
      {# Footer Bottom #}
      <div class=\"footerlower\">
        {# Footer Social Site Icons to be shown on top for Mobile.#}
        <div class=\"socialiconmobile\">
          {{ page.footer_social_icon }}
        </div>
        
        <div class=\"footer_legal_section\">
          {# Footer Logo #}
              <div class=\"branding\">
                <a href=\"{{ path('<front>') }}\" rel=\"home\">
                  <img class=\"footer_logo\" src=\"themes/custom/foxnews/assets/images/logo/fox-news-footer-logo-square.svg\" />
                </a>
              </div>
              {# Footer Legal Information #}
              <div class=\"legal\">
                {{ page.footer_legal }}
                {{ page.footer_legal_text}}
              </div>
              {# Footer Social Icon to be shown at righty corner for Laptop #}
              <div class=\"socialiconlaptop\">
                {{ page.footer_social_icon }}
              </div>
        </div>
      </div>
    </footer>
  {% endif %}
", "themes/custom/autoarenaindia/templates/page.html.twig", "/var/www/html/web/themes/custom/autoarenaindia/templates/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 58);
        static $filters = array("escape" => 56);
        static $functions = array("path" => 100);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                ['path']
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

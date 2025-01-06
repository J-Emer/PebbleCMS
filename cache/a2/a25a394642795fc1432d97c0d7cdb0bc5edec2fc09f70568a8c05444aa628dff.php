<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* base.twig.html */
class __TwigTemplate_5755c51bf2d3eab76a7d7fb4be18cad6c5ea824f159919c6f526a4e938058b64 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</title>
    <link rel=\"stylesheet\" href=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Jemer\PebbleCms\TwigExtensions\AssetExtension']->getCssUrl("style.css"), "html", null, true);
        yield "\">
    <script src=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Jemer\PebbleCms\TwigExtensions\AssetExtension']->getJsUrl("main.js"), "html", null, true);
        yield "\"></script>
</head>
<body>
    <header>
        <h1><a href=\"/\">Pebble CMS</a></h1>
        <nav>
            <ul>
                <li><a href=\"/\">Home</a></li>
                <li><a href=\"/page/about\">About</a></li>
                <li><a href=\"/page/contact\">Contact</a></li>
                ";
        // line 18
        if ((array_key_exists("categories", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["categories"] ?? null)))) {
            // line 19
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 20
                yield "                        <li><a href=\"/category/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["category"], "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["category"], "html", null, true);
                yield "</a></li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['category'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            yield "                ";
        }
        // line 23
        yield "            </ul>
        </nav>
    </header>
    <main>
        ";
        // line 27
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 28
        yield "    </main>
    <footer>
        <p>&copy; ";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " PebbleCMS</p>
    </footer>
</body>
</html>
";
        yield from [];
    }

    // line 27
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.twig.html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  114 => 27,  104 => 30,  100 => 28,  98 => 27,  92 => 23,  89 => 22,  78 => 20,  73 => 19,  71 => 18,  58 => 8,  54 => 7,  50 => 6,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{{ title }}</title>
    <link rel=\"stylesheet\" href=\"{{ css('style.css') }}\">
    <script src=\"{{ js('main.js') }}\"></script>
</head>
<body>
    <header>
        <h1><a href=\"/\">Pebble CMS</a></h1>
        <nav>
            <ul>
                <li><a href=\"/\">Home</a></li>
                <li><a href=\"/page/about\">About</a></li>
                <li><a href=\"/page/contact\">Contact</a></li>
                {% if categories is defined and categories is not empty %}
                    {% for category in categories %}
                        <li><a href=\"/category/{{ category }}\">{{ category }}</a></li>
                    {% endfor %}
                {% endif %}
            </ul>
        </nav>
    </header>
    <main>
        {% block content %}{% endblock %}
    </main>
    <footer>
        <p>&copy; {{ \"now\"|date(\"Y\") }} PebbleCMS</p>
    </footer>
</body>
</html>
", "base.twig.html", "C:\\Users\\jemer\\WebProjects\\PebbleCMS\\themes\\default\\base.twig.html");
    }
}

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

/* category.twig.html */
class __TwigTemplate_dfb02b99610bf44d314036c7b9439d8266f88868b99aaa2f72bae4dc93aa7a10 extends Template
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
    <title>Posts in ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["category"] ?? null), "html", null, true);
        yield "</title>
</head>
<body>
    <h1>Posts in ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["category"] ?? null), "html", null, true);
        yield "</h1>

    ";
        // line 11
        if (Twig\Extension\CoreExtension::testEmpty(($context["posts"] ?? null))) {
            // line 12
            yield "        <p>No posts found in this category.</p>
    ";
        } else {
            // line 14
            yield "        <ul>
        ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 16
                yield "            <li>
                <a href=\"/post/";
                // line 17
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "slug", [], "any", false, false, false, 17), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 17), "html", null, true);
                yield "</a>
                <p><strong>By:</strong> ";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "author", [], "any", false, false, false, 18), "html", null, true);
                yield " | <strong>Date:</strong> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "date", [], "any", false, false, false, 18), "html", null, true);
                yield "</p>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['post'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            yield "        </ul>
    ";
        }
        // line 23
        yield "</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "category.twig.html";
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
        return array (  97 => 23,  93 => 21,  82 => 18,  76 => 17,  73 => 16,  69 => 15,  66 => 14,  62 => 12,  60 => 11,  55 => 9,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Posts in {{ category }}</title>
</head>
<body>
    <h1>Posts in {{ category }}</h1>

    {% if posts is empty %}
        <p>No posts found in this category.</p>
    {% else %}
        <ul>
        {% for post in posts %}
            <li>
                <a href=\"/post/{{ post.slug }}\">{{ post.title }}</a>
                <p><strong>By:</strong> {{ post.author }} | <strong>Date:</strong> {{ post.date }}</p>
            </li>
        {% endfor %}
        </ul>
    {% endif %}
</body>
</html>
", "category.twig.html", "C:\\Users\\jemer\\WebProjects\\PebbleCMS\\themes\\default\\category.twig.html");
    }
}

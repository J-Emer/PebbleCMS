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
class __TwigTemplate_40e8056394ba23e51a62c8be6f5c7c6e71eec7c9f07432948c09f2c6b443493b extends Template
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

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.twig.html";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.twig.html", "category.twig.html", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "    <h1>Posts in \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["category"] ?? null), "html", null, true);
        yield "\"</h1>

    ";
        // line 6
        if (Twig\Extension\CoreExtension::testEmpty(($context["posts"] ?? null))) {
            // line 7
            yield "        <p>No posts found in this category.</p>
    ";
        } else {
            // line 9
            yield "        <ul>
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 11
                yield "            <li>
                <a href=\"/post/";
                // line 12
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "slug", [], "any", false, false, false, 12), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 12), "html", null, true);
                yield "</a>
                <small>by ";
                // line 13
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "author", [], "any", false, false, false, 13), "html", null, true);
                yield " on ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "date", [], "any", false, false, false, 13), "html", null, true);
                yield "</small>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['post'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            yield "        </ul>
    ";
        }
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
        return array (  97 => 16,  86 => 13,  80 => 12,  77 => 11,  73 => 10,  70 => 9,  66 => 7,  64 => 6,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.twig.html\" %}

{% block content %}
    <h1>Posts in \"{{ category }}\"</h1>

    {% if posts is empty %}
        <p>No posts found in this category.</p>
    {% else %}
        <ul>
        {% for post in posts %}
            <li>
                <a href=\"/post/{{ post.slug }}\">{{ post.title }}</a>
                <small>by {{ post.author }} on {{ post.date }}</small>
            </li>
        {% endfor %}
        </ul>
    {% endif %}
{% endblock %}
", "category.twig.html", "C:\\Users\\jemer\\WebProjects\\PebbleCMS\\themes\\default\\category.twig.html");
    }
}

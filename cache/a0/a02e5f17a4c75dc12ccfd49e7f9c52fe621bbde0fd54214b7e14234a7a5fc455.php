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
class __TwigTemplate_873fce5ef74694e3adca84fcab10c7dbee8e6505c7e208195773dc066c7f373a extends Template
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Jemer\PebbleCms\TwigExtensions\AssetPathExtension']->getAssetPath("style", "css"), "html", null, true);
        yield "\">
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
        // line 17
        if ((array_key_exists("categories", $context) &&  !Twig\Extension\CoreExtension::testEmpty(($context["categories"] ?? null)))) {
            // line 18
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 19
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
            // line 21
            yield "                ";
        }
        // line 22
        yield "            </ul>
        </nav>
    </header>
    <main>
        ";
        // line 26
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 27
        yield "    </main>
    <footer>
        <p>&copy; ";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " PebbleCMS</p>
    </footer>
</body>
</html>
";
        yield from [];
    }

    // line 26
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
        return array (  110 => 26,  100 => 29,  96 => 27,  94 => 26,  88 => 22,  85 => 21,  74 => 19,  69 => 18,  67 => 17,  54 => 7,  50 => 6,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "base.twig.html", "C:\\Users\\jemer\\WebProjects\\PebbleCMS\\themes\\default\\base.twig.html");
    }
}

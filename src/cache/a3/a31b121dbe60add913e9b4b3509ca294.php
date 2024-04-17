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

/* main.twig */
class __TwigTemplate_a04a96c1509712637ec1688022156e46 extends Template
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
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
    <link rel=\"stylesheet\" href=\"../CSS/main.css\">
</head>
<body>
    <div class=\"navbar\">
        <a class = \"text_navbar\" href=\"http://localhost:50180/PHP/connection_index.php\">Accueil</a>
        ";
        // line 12
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "username", [], "any", true, true, false, 12)) {
            // line 13
            echo "            <div class = \"text_navbar\">
                <li id = \"username\">";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "username", [], "any", false, false, false, 14), "html", null, true);
            echo " </li><a href=\"logout.php\">Déconnexion</a>
            </div>
        ";
        } else {
            // line 17
            echo "            <div>
                <a href=\"../HTML/login.html\">Connexion</a>
            </div>
        ";
        }
        // line 21
        echo "    </div>
    <div class=\"dashboard\">
        <div class=\"data-container\">
            <div class=\"data\">

            </div>
            <div class=\"data\">
                
            </div>
            <div class=\"data\">
                
            </div>
        </div>
         <div class=\"map-container\">
            <img src=\"\" alt=\"cartographie de la zone\">
        </div>
    </div>
    <div class=\"dashboard\">
      
        <div class=\"camera\">
            <video controls >
            </video>
        </div>
        <div class=\"controler-container\">
            <div class=\"log\">
                <table id=\"keyPressTable\">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Direction</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        
                    </tbody>
                </table>
            </div>
            <div class=\"mode\">
                <button class=\"mode-button\"><p>Auto</p></button> <!-- Flèche vers la gauche -->
                <button class=\"mode-button\"><p>Manuelle</p></button> <!-- Flèche vers le bas -->
                <button class=\"mode-button\"><p>Semi</p></button>
            </div>
            <div class=\"controler\">
                <div class=\"up-arrow-container\">
                    <button class=\"control-button\" data-keyboard-key=\"ArrowUp\">&#8593;</button> <!-- Flèche vers le haut -->
                </div>
                <div class=\"another-arrow-container\">
                    <button class=\"control-button\" data-keyboard-key=\"ArrowLeft\">&#8592;</button> <!-- Flèche vers la gauche -->
                    <button class=\"control-button\" data-keyboard-key=\"ArrowDown\">&#8595;</button> <!-- Flèche vers le bas -->
                    <button class=\"control-button\" data-keyboard-key=\"ArrowRight\">&#8594;</button> <!-- Flèche vers la droite -->
                </div>
               
            </div>
        </div>
    </div>
    <div class=\"dashboard\">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Objet</th>
                    <th>Rencontre</th>
                </tr>
            </thead>
            <tbody>
               
               
                <!-- Autres lignes de la table seront ajoutées ici dynamiquement -->
            </tbody>
        </table>
    </div>

</body>
<script src=\"../JS/main.js\"></script>

</html>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "main.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  67 => 21,  61 => 17,  55 => 14,  52 => 13,  50 => 12,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.twig", "/var/www/html/HTML/main.twig");
    }
}

<?php
require_once dirname(__FILE__) . '/../form/form.php';

function header_html(){
    $language = isset($_POST['language_toggle']) ? $_POST['language_toggle'] : 'english';

    // Link to the external CSS file
    echo '<link rel="stylesheet" href="' . plugins_url('shifti-import/src/styles/home.css') . '">';

    echo '<div class="header-container">';
    echo '<img class="logo_img" src="' . plugins_url('shifti-import/src/img/logo.png') . '" alt="Logo Shifti">';
    echo '<h1>' . ($language === 'english' ? 'Welcome to the Shifti Data Connector Plugin !' : 'Bienvenue dans le plugin de connexion de données Shifti !') . '</h1>';

    echo '<div class="content-box">';
    echo '<p>' . ($language === 'english' ? 'This versatile module allows seamless integration between your WooCommerce Shop and the Shifti web app. Easily configure the module using the intuitive form below. Experience enhanced data management and boost your sales with this powerful module.' : 'Ce module polyvalent permet une intégration transparente entre votre boutique WooCommerce et l\'application web Shifti. Configurez facilement le module à l\'aide du formulaire intuitif ci-dessous. Bénéficiez d\'une gestion améliorée des données et boostez vos ventes avec ce module puissant.') . '</p>';
    echo '<p>' . ($language === 'english' ? 'This plugin provides convenient options to download various data types from your WooCommerce store. You can download categories, orders, customers, order notes, taxes, and products in JSON format. Additionally, you can fetch data from a Go API endpoint for further integration.' : 'Ce plugin offre des options pratiques pour télécharger différents types de données depuis votre boutique WooCommerce. Vous pouvez télécharger des catégories, des commandes, des clients, des notes de commande, des taxes et des produits au format JSON. De plus, vous pouvez récupérer des données à partir d\'un point d\'API Go pour une intégration ultérieure.') . '</p>';
    echo '</div>';

    echo '<div class="content-box documentation">';
    echo '<h2>' . ($language === 'english' ? 'Documentation' : 'Documentation') . '</h2>';
    echo '<p>' . ($language === 'english' ? '» You can download the PDF documentation for this module:' : '» Vous pouvez télécharger la documentation PDF pour ce module :') . '</p>';
    echo '<ul>';

    // Add French documentation download link
    echo '<li>';
    echo '<a href="' . plugins_url('shifti-import/sample.pdf') . '" download>' . ($language === 'english' ? 'French' : 'Français') . '</a>';
    echo '</li>';

    // Add English documentation download link
    echo '<li>';
    echo '<a href="' . plugins_url('shifti-import/sample.pdf') . '" download>' . ($language === 'english' ? 'English' : 'Anglais') . '</a>';
    echo '</li>';

    echo '</ul>';

    // Language toggle button form
    echo '<form method="post">';
    echo '<input type="hidden" name="language_toggle" value="' . ($language === 'english' ? 'french' : 'english') . '">';
    echo '<button type="submit">' . ($language === 'english' ? 'Switch to French' : 'Switch to English') . '</button>';
    echo '</form>';

    echo '</div>';
    form_html();
    echo '</div>';
}
?>


<?php
//phpinfo();
if(!isset($_SESSION['login']) && !defined('CONST_INCLUDE')){
    session_start();
    define('CONST_INCLUDE',NULL);/*on definit une constante pour dire que l'on passe par l'index
    auquel cas une alert se declenchera pour specifier que l'acces est interdit*/
}
//on met en tampon tout les affichage (or template,module calculé...) qui se charge avant qu'il n'apparaissent

ob_start();
if (isset($_GET['modules'])) {
    switch ($_GET['modules']) {
        case 'connexion':
            require_once 'modules/mod_connexion/controleurInscription.php';
            $contConnexion = new ControleurInscription();
            $contConnexion -> menu(); ?>
            <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
      
        <link rel="stylesheet" href="style.css">
        <script src="jquery.js"></script>
        <script src="script.js"></script>
    </head>
</html>
        <?php
        break;
        case 'administration':
            require_once 'modules/mod_administration/controleurAdministration.php';
            $contAdmin = new ControleurAdministration();
            $contAdmin -> menu();
        break;
        case 'questionnaire':
            require_once 'modules/mod_questionnaire/controleurQuestionnaire.php';
            $contQuestionnaire = new ControleurQuestionnaire();
            $contQuestionnaire->menu();
        default:
        break;
    }

}
$module = ob_get_clean();//on recupere l'affichage des modules
ob_start();
$menu = ob_get_clean();
require('template.php'); ?>





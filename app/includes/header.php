<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
    "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html>
    <head profile="http://www.w3.org/1999/xhtml/vocab">  
        <title> Publications- MIS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta about="/fr/node/5" property="sioc:num_replies" content="0" datatype="xsd:integer" />
        <link rel="shortcut icon" href="https://www.mis.u-picardie.fr/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="canonical" href="/fr/node/5" />
        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
        <link rel="stylesheet" href="css/global.css" />
        <link rel="stylesheet" type="text/css" href="css/datatable-pretty.css">
        <link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="css/datatable-pretty.css">
        <style type="text/css" media="all">
            @import url("https://www.mis.u-picardie.fr/modules/system/system.base.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/system/system.menus.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/system/system.messages.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/system/system.theme.css?n73p4e");</style>
        <style type="text/css" media="all">@import url("https://www.mis.u-picardie.fr/modules/comment/comment.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/field/theme/field.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/node/node.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/search/search.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/modules/user/user.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/sites/all/modules/views/css/views.css?n73p4e");</style>
        <style type="text/css" media="all">@import url("https://www.mis.u-picardie.fr/sites/all/modules/ckeditor/ckeditor.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/sites/all/modules/ctools/css/ctools.css?n73p4e");
            @import url("https://www.mis.u-picardie.fr/sites/all/modules/lightbox2/css/lightbox.css?n73p4e");</style>
        <style type="text/css" media="all">@import url("https://www.mis.u-picardie.fr/sites/all/themes/bluemasters/style.css?n73p4e");</style>
        <?php include_once INCLUDES.'javascripts.php';?>
    </head>
    <body class="html not-front not-logged-in no-sidebars page-node page-node- page-node-5 node-type-page i18n-fr" >
        <div id="skip-link">
            <a href="#main-content" class="element-invisible element-focusable">Aller au contenu principal</a>
        </div>
        <div id="page">
            <div id="header-top">
                <div id="header-top-inside" class="clearfix">
                    <div id="header-top-inside-right"> 
                        <!--TODO : Connexion-->
                        <?php if (isIdentifie()): ?>
                            <a class="login" href="index.php?vue=publique&action=disconnect" title="espace perso">
                                <img src="images/logout.png" />
                            </a>
                        <?php else: ?>
                            <a class="login" href="index.php?vue=publique&action=connect" title="espace perso">
                                <img src="images/login.png" />
                            </a>
                        <?php endif ?>
                    </div> 
                </div>
            </div> 
            <div id="wrapper">
                <div id="header" class="clearfix">
                    <div id="logo-floater"> 
                        <a href="https://www.mis.u-picardie.fr/" title="Accueil">
                            <img style="vertical-align:bottom; width:358px;" src="https://www.mis.u-picardie.fr/sites/all/themes/bluemasters/logo.png" alt="Accueil" />
                        </a>
                        <span id="site-name">Modélisation, Information &amp; Systèmes</span>
                    </div>  
                </div>
                <div id="navigation">
                    <ul class="menu"><li class="first leaf"><a href="#" title="">Accueil</a></li>
                        <li class="expanded"><a href="#">Le MIS</a><ul class="menu"><li class="first leaf"><a href="#">Organisation</a></li>
                                <li class="leaf"><a href="#">Annuaire</a></li>
                                <li class="leaf"><a href="#">Contacts</a></li>
                                <li class="leaf"><a href="#">Accès au MIS</a></li>
                                <li class="last leaf"><a href="#">Rapports d&#039;activité</a></li>
                            </ul></li>
                        <li class="expanded"><a href="#">Recherche</a><ul class="menu"><li class="first expanded"><a href="#">Equipes</a><ul class="menu"><li class="first leaf"><a href="#">COS</a></li>
                                        <li class="leaf"><a href="#">COVE</a></li>
                                        <li class="leaf"><a href="#">GOC</a></li>
                                        <li class="leaf"><a href="#">PR</a></li>
                                        <li class="last leaf"><a href="#">SDMA</a></li>
                                    </ul></li>
                                <li class="expanded"><a href="#" title="">Actions Inter-Equipes</a><ul class="menu"><li class="first leaf"><a href="/fr/node/27">Action Equipe PR - COVE</a></li>
                                        <li class="leaf"><a href="#">Action Equipe PR - SDMA</a></li>
                                        <li class="last leaf"><a href="#">Action Equipe SDMA - COVE</a></li>
                                    </ul></li>
                                <li class="leaf"><a href="http://mis.u-picardie.fr/E-Cathedrale/" title="">Axe E-Cathédr@le</a></li>
                                <li class="last expanded"><a href="#" title="">Projets et Collaborations</a><ul class="menu"><li class="first leaf"><a href="#">Industriels</a></li>
                                        <li class="collapsed"><a href="#" title="">Régionaux</a></li>
                                        <li class="collapsed"><a href="#" title="">Nationaux</a></li>
                                        <li class="last collapsed"><a href="#" title="">Internationaux</a></li>
                                    </ul></li>
                            </ul></li>
                        <li class="expanded"><a href="#">Animations scientifiques</a><ul class="menu"><li class="first leaf"><a href="#" title="">Séminaires de laboratoire</a></li>
                                <li class="leaf"><a href="#" title="">Séminaires d&#039;équipe</a></li>
                                <li class="leaf"><a href="#" title="">Journées d&#039;études</a></li>
                                <li class="leaf"><a href="#">Colloques</a></li>
                                <li class="leaf"><a href="#">Grand public</a></li>
                                <li class="last leaf"><a href="#">Soutenances</a></li>
                            </ul></li>
                        <li class="expanded active-trail"><a href="#" class="active-trail active">Production</a>
                            <ul class="menu">
                                <li class="first expanded active-trail"><a href="index.php?vue=publique&action=recherche" class="active-trail active">Publications</a>
                                    <?php if(isIdentifie()):?>
                                    <ul class="menu">
                                        <li><a href="index.php?vue=chercheur&action=liste">Mes Publications</a></li>
                                        <?php if(isApprobateur()): ?>
                                            <li><a href="index.php?vue=approbateur&action=liste">Validations</a></li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php endif ?>
                                </li>
                                <li class="collapsed"><a href="#" title="">Démonstrations et logiciels</a></li>
                                <li class="last leaf"><a href="#">Rapports d&#039;activité</a></li>
                            </ul></li>
                        <li class="last expanded"><a href="#" title="">Formations</a><ul class="menu"><li class="first leaf"><a href="https://mis.u-picardie.fr/Stages-Master/" title="">Stages</a></li>
                                <li class="leaf"><a href="#" title="">Master STIC</a></li>
                                <li class="leaf"><a href="#" title="">Département EEA</a></li>
                                <li class="leaf"><a href="#" title="">UFR des Sciences</a></li>
                                <li class="leaf"><a href="#" title="">Ecole doctorale</a></li>
                                <li class="last leaf"><a href="#" title="">UPJV</a></li>
                            </ul></li>
                    </ul>        
                </div>
                <div id="main-area" class="clearfix">

                    <div id="main-area-inside" class="clearfix">

                        <div id="main"  class="inside clearfix">

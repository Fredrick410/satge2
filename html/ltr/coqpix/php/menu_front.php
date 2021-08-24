<?php
    require_once 'php/permissions_front.php';
?>

<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <style>
            
            .logocoq{
                width:70%;
                height: 100%;
            }
            
            </style>
            <li class="nav-item mr-auto modern-nav-toggle text-center">
                <img class="logocoq" src="../../../app-assets/images/logo/coqpix1.png" />
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item"><a href="#"><div class="livicon-evo" data-options=" name: rocket.svg; style:filled; size: 30px "></div>&nbsp&nbsp&nbsp<span class="menu-title" data-i18n="Dashboard">Coqpit</span></a>
                <ul class="menu-content">
                    <li><a href="dashboard-analytics.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Analytique</span></a>
                    </li>
                    <li><a href="page-coming-soon.html#dashboard-ecommerce.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">eCommerce</span>&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                    </li>
                    <li><a href="file-manager.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Cloudpix">CloudPix</span></a>
                    </li>
                    <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Chat">Chat'Pix</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Fonctions</span>
            </li>

            <!-- VENTES -->
            <?php if (permissions()['ventes'] >= 1) { ?>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Ventes">Ventes</span></a>
                    <ul class="menu-content">
                        <li><a href="app-devis-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Devis">Devis</span></a>
                        </li>
                        <li><a href="app-invoice-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Facture">Factures</span></a>
                        </li>
                        <li><a href="app-avoir-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Avoir">Avoirs</span></a>
                        </li>
                        <li><a href="app-bon-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bon de livraison">Bons de livraison</span></a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="#"><i class="menu-livicon" data-icon="coins"></i><del class="menu-title" data-i18n="Ventes">Ventes</del></a></li>
            <?php } ?>

            <!-- ACHATS -->
            <?php if (permissions()['achats'] >= 1) { ?>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Achats">Achats</span></a>
                    <ul class="menu-content">
                        <li><a href="app-invoice-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Factures">Factures</span></a>
                        </li>
                        <li><a href="app-bon-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bulletin de commande">Bulletins de commande</span></a>
                        </li>
                        <li><a href="app-note-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Note de frais">Note de frais</span></a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="#"><i class="menu-livicon" data-icon="us-dollar"></i><del class="menu-title" data-i18n="Achats">Achats</del></a></li>
            <?php } ?>

            <!-- PROJETS -->
            <?php if (permissions()['projets'] >= 1) { ?>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Projet">Projets</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#mission.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Mission">Missions &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></span></a>
                        </li>
                        <li><a href="teams-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Equipes">Teams</a>
                        </li>
                        <li><a href="task.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Taches">Taches</span></a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="#"><i class="menu-livicon" data-icon="users"></i><del class="menu-title" data-i18n="Projet">Projets</del></a></li>
            <?php } ?>

            <!-- INVENTAIRE -->
            <?php if (permissions()['inventaire'] >= 1) { ?>
                <li class=" nav-item"><a href="inventaire-list.php"><i class="menu-livicon" data-icon="box-add"></i><span class="menu-title" data-i18n="Stockage">Inventaire</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a></li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="inventaire-list.php"><i class="menu-livicon" data-icon="box-add"></i><del class="menu-title" data-i18n="Stockage">Inventaire</del><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a></li>
            <?php } ?>
            
            <!-- BUSINESS -->
            <li class=" nav-item"><a href="opportunite.php"><i class="menu-livicon" data-icon="trophy"></i><span class="menu-title" data-i18n="Buisness">Business</span><span class="badge badge-light-warning badge-pill badge-round float-right">VIP</span></a>
            </li>

            <!-- FORMATIONS -->
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-title" data-i18n="Formation">Formations</span></a>
                <ul class="menu-content">
                    <li><a href="page-coming-soon.html#academy.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Academy">Pix'Academy</span>&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                    </li>
                    <li><a href="#maforma.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="MA FORMA">Ma Forma</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                    </li>
                </ul>
            </li>
            
            <!-- RH -->
            <li class=" nav-item"><a href="rh-home.php"><i class="menu-livicon" data-icon="diagram"></i><span class="menu-title" data-i18n="Stockage">RH</span><span class="badge badge-light-warning badge-pill badge-round float-right">VIP</span></a>
            </li>

            <!-- Veille -->
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="sky-dish"></i><span class="menu-title" data-i18n="Veille">Veille</span></a>
                <ul class="menu-content">
                    <li><a href="bookmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="bookmarks">BookMarks</span></a>
                    </li>
                    <li><a href="#benchmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="benchmark">BenchMark</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header"><span>Données</span>
            </li>

            <!-- CLIENTS -->
            <?php if (permissions()['clients'] >= 1) { ?>
                <li class=" nav-item"><a href="client.php"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Clients">Clients</span></a></li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="client.php"><i class="menu-livicon" data-icon="user"></i><del class="menu-title" data-i18n="Clients">Clients</del></a></li>
            <?php } ?>

            <!-- FOURNISSEURS -->
            <?php if (permissions()['fournisseurs'] >= 1) { ?>
                <li class=" nav-item"><a href="fournisseur-list.php"><i class="menu-livicon" data-icon="truck"></i><span class="menu-title" data-i18n="Fournisseurs">Fournisseurs</span></a></li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="fournisseur-list.php"><i class="menu-livicon" data-icon="truck"></i><del class="menu-title" data-i18n="Fournisseurs">Fournisseurs</del></a></li>
            <?php } ?>

            <!-- ARTICLES -->
            <?php if (permissions()['articles'] >= 1) { ?>
                <li class=" nav-item"><a href="article-list.php"><i class="menu-livicon" data-icon="tag"></i><span class="menu-title" data-i18n="Articles">Articles</span></a></li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="article-list.php"><i class="menu-livicon" data-icon="tag"></i><del class="menu-title" data-i18n="Articles">Articles</del></a></li>
            <?php } ?>

            <!-- MEMBRES -->
            <?php if (permissions()['membres'] >= 1) { ?>
                <li class=" nav-item"><a href="membres-liste.php"><i class="menu-livicon" data-icon="grid"></i><span class="menu-title" data-i18n="Membres">Membres</span></a></li>
            <?php } else { ?>
                <li class="disabled nav-item"><a href="membres-liste.php"><i class="menu-livicon" data-icon="grid"></i><del class="menu-title" data-i18n="Membres">Membres</del></a></li>
            <?php } ?>

            <li class=" navigation-header"><span>Déclarations</span>
            </li>
            <li class=" nav-item"><a href="social.php"><i class="menu-livicon" data-icon="umbrella"></i><span class="menu-title" data-i18n="Charts">Sociales</span></span></a>
            </li>
            <li class=" nav-item"><a href="fiscale.php"><i class="menu-livicon" data-icon="piggybank"></i><span class="menu-title" data-i18n="Google Maps">Fiscales</span></a>
            </li>
            <li class=" nav-item"><a href="bilan.php?5PAx4zf27P=<?= date('Y') - 1 ?>&S3q4EvFDk4QZ95b4v3gz"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Bilans">Bilans</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#balance.php"><i class="menu-livicon" data-icon="balance"></i><span class="menu-title" data-i18n="Balances">Balances</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" navigation-header"><span>Divers</span>
            </li>
            <li class=" nav-item"><a href="#shop.php"><i class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title" data-i18n="shoppingcart">Shop'ix</span><span class="badge badge-light-info badge-pill badge-round float-right">PROMO</span></a>
            </li>
            <li class=" nav-item"><a href="outils.php"><i class="menu-livicon" data-icon="heart"></i><span class="menu-title" data-i18n="Google Maps">Outils</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#financement.php"><i class="menu-livicon" data-icon="credit-card-in"></i><span class="menu-title" data-i18n="Google Maps">Financement</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#assurance.php"><i class="menu-livicon" data-icon="car"></i><span class="menu-title" data-i18n="Google Maps">Assurance</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" nav-item"><a href="news.php"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Google Maps">News</span></a>
            </li>
            <li class=" nav-item"><a href="faq.php"><i class="menu-livicon" data-icon="info"></i><span class="menu-title" data-i18n="Google Maps">FAQ</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
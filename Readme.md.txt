
branch de oscar : 
tache realiser 16/06/2021
	- bouton retour page creation chat fait
	- forme arrondi input formulaire creation societe

tache realiser 17/06/2021
	- formulaire creation societe presque fini -> input telephone est terminer

branch de robin :

tache réalisé 16/06/21
implementation du site + bdd sur ma machine,
essai de réorientation du bouton sur page-creation-chat.php
travail sur page creation-societe

tache réalisé 17/06/21
creation de domiciliation.php


branch de leo :
tache réalisée 17/06/21
	-barre de recherche sur domiciliation.php
	-creation de php/recherche-domiciliation.php qui renvoie vers le site de Multiburo.com à partir de domiciliation.php

tache réalisée 18/06/21
	-refonte de domiciliation.php : la page multiburo.com est désormais directement intégrée à la page domiciliation.php
	-création de header-crea.php contenant le header commun aux pages
			->les pages sont liées à header-crea.php pour simplifier la modification du header
	-modification header-crea.php : le logo renvoie vers la page d'accueil utilisateur
	
branch de oscar :
tache réalisé le 18/06/2021
	- travail sur la page crea societe (passage en full screen, ajout librairie pour l'input de telephone)	

branch de leo :
	tache réalisée 21/06/21
		-page crea societe : le formulaire envoie le telephone sous la bonne forme (+33...) dans la bdd
		-page-creation-edit.php : me formulaire reçoit et envoie le telephone sous la bonne forme (+33...)

branch de robin :
	tache réalisée 21/06/21
		-verification que les mdp correspondent aux conditions dans creation-societe
		-implementation de verif mail

branch de leo :
	tache réalisée 22/06/21
		-verif mdp
		-telephone drapeau france par défaut
		-cryptage mot de passe (connexion + inscription + edit profil)

	tache réalisée 25/06/21
		-visuel du chat popup domiciliation terminé

branch de oscar :
	tache réalisée le 23/06/2021
		-page domiciliation.php ->barre de recherche 
								->carte avec les adresses

	tache réalisée le 24/06/2021
		-page domiciliation.php ->affichage des offres des adresses a gauche de la carte
		- création page domiciliation-offre.php ->carousel, description de l'adresse/offre

branch de robin :
	tache réalisée 25/06/21
		-suggestion de villes sur domiciliation.php

branche de leo :
	tache réalisée 28/06/21
		-factorisation du chat
		-liaison du chat (chat censé être fonctionnel, à tester en ligne car le chat ne fonctionne pas en local)

	tache réalisée 29/06/2021
		-chat present sur offre domiciliation
		-inclusion du 'type' (domiciliation, coworking...) lors de la recherche (boutons fonctionnels)

branch de robin :
	tache réalisée 29/06/21
		-affichage des boutons correspondant sur offre domiciliation
		-affichage de la description de l'offre sur offre domiciliation

branche de oscar:
	tache réalisée le 28/06/2021:
		-création page accueil crea

	tache réalisée le 29/06/2021:
		-partie domiciliation ajouté à la page accueil crea
		-partie documents ajouté à la page accueil crea
		-tchat ajouté à la page d'accueil crea

btanche de leo :
	tache réalisée le 30/06/2021:
		-base de données : offre-domiciliation fixed et ajout de la partie img
		-ajout des images sur domiciliation
		-rectification chat : petite fleche à droite en "popup"

branche de oscar :
	tache réalisée le 01/07/2021 :
		- page-creation.php responsive
		- ajout des caractéristique des offres de domiciliation page domiciliation-offre.php
		- creation de page-creation-edit-test.php : travail sur le front

branche de leo :
	tache réalisée le 01/07/2021
		-bdd : ajout de la colonne caracteristique dans la table offre-domiciliation
		-domiciliation-offre.php : ajout des caractéristiques
		-fix bug page-creation-edit : on ne pouvait pas sauvegarder si on ne modifiait pas le telephone
		-ajout des "carousel" dans la page domiciliation pour les offres

	tache réalisée
		-bouton radio sur offre-domiciliation et fix js

branche de oscar :
	tache réalisée le 08/07/2021 :
		- page ajout document compte crea fini
		- fix affichage info dirigeant page crea
		- pop-up message back end dans creation société
		- alert retirer dans la back end dans crea société
		- ajout item conversation back end dans creation societe
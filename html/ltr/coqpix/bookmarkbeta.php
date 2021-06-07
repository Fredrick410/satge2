<?php

/**
 * Favilink
 *
 * Affiche un lien précédé du favicon
 * du site internet de destination.
 *
 * @author PHPLizardo
 * @version 1
 * @license CC BY-NC-SA
 *
 * @param string $url url à laquelle vous souhaitez ajouter le favicon.
 * @param string $text Si vous souhaitez un texte personnalisé pour lien.
 * @param string $alt favicon alternative dans le cas ou le site internet
 *concerné n'en possède pas.
 *
 */

function favilink($url, $text = NULL, $alt = NULL)
{

    /**
     * Si un texte pour le lien est fourni, on utilise ce dernier,
     * dans le cas contraire, on affiche l'url donnée.
     */

    if ($text != NULL)
        $text = $text;
    else
        $text = $url;

    /**
     * La valeur du paramètre $url doit impérativement
     * être un url valide. On vérifie cette condition.
     */

    $url = filter_var($url, FILTER_VALIDATE_URL);

    if ($url !== FALSE) {

        /**
         * Nous devons extraire le nom de domain de l'url
         * passée en paramètre. On découpe l'url en portions.
         */

        $parts = parse_url($url);

        /**
         * Récupération du nom de domaine par recomposition de
         * l'url précédemment découpée.
         */

        $domain = $parts['scheme'] . '://' . $parts['host'];

        /**
         * Récupération du favicon. On recherche le favicon dans le répertoire
         * racine du site internet car c'est l'endroit le plus répendu. Si, et
         * seulement si le fichier n'existe pas, on télécharge la page distante
         * et on extrait l'adresse du favicon depuis l'en-tête de la page.
         */

        $favicon = $domain . '/favicon.ico';

        //if ( !file_get_contents ( $favicon ) ){
        if (!@file_get_contents($favicon)) {

            $page = file_get_contents($domain);

            if (preg_match('##', $page, $match)) {

                $favicon = $match[3];
            } else {

                /**
                 * Si il n'y a aucun favicon défini pour ce site internet, dans le cas ou une
                 * image alternative est fourni, on affiche cette dernière, sinon on affiche rien.
                 */
                if ($alt != null)
                    $favicon = $alt;
                else
                    return '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($text) . '</a>';
            }

            /**
             * Si c'est une adresse abosulue, par exemple dans le cas où le favicon
             * est situé sur un site internet externe ou un sous-domaine, on récupère
             * l'adresse entière. Sinon on combine le nom de domaine et l'adresse relative
             * du favicon pour recréer une adresse valide.
             */

            if (filter_var($favicon, FILTER_VALIDATE_URL) === FALSE) {

                /**
                 * On retire l'éventuel slash (/) qui se situe au début de l'adresse
                 * relative pour éviter le double slash.
                 */

                if ($favicon[1] == '/')
                    $favicon = substr($favicon, 1);

                $favicon = $domain . $favicon;
            }
        }

        return '<img title=" ' . htmlspecialchars($domain) . ' " src="' . htmlspecialchars($favicon) . '" alt="" /> ' . '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($text) . '</a>';
    }
}
?>

<?php
echo favilink('https://youtube.com', 'Le blog de LudiKreation') . '<br />';
echo favilink('http://www.youtube.com', 'Le site de LudiKreation');

?>
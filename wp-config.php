<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'pierretest');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'bx_6=8=`67L _UX>%s6tb?/Z^v,f>ZiWD5}:>9QlWBEM3e;kON%&jX;+=|bwA?J~');
define('SECURE_AUTH_KEY',  'SHmh(t?/9ftaC1UxAsO}xaobn`c9-#IdYI:j(c!GVvGr#y|Cm!wDxu-fY$}QkkSa');
define('LOGGED_IN_KEY',    'NDpi{ZGa3Zj&=%n8: 5}c(2SQsGzw*iMwKmFih~fcOC+q/WjE>SV|XCwkO%-#nJ/');
define('NONCE_KEY',        '7}J#kipAi(LN?PmZyI6K2;-]i ~^x|aMz~d)isV/:.4>:8HK 8(}/$^WAPPJCuz$');
define('AUTH_SALT',        'JG5G7gE=!#8**{sj=55-O{$t~:8^>Hylez+a]eg;OUu2^P * x !E}]@Xc(u[xvq');
define('SECURE_AUTH_SALT', '<GtYH*Tg!c5f8-a2t zVNi~,*}!E}8UFj!U#u<$fvQ8zKv,JezVK}M0!^$0ZV|xz');
define('LOGGED_IN_SALT',   's{zS 71N(_f>oh8PC` C8k8&c}^VG$lx<.+xI}gDH#Zf[&j5cBX`tL^te@sqZ)9g');
define('NONCE_SALT',       'suS=z?jb^LcQnhQ[C|4!{3&):wKqNR4eLN^gQ]iJrwVjjhh>Ik[w}KsWhjA_JUD3');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'pierre_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', TRUE);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
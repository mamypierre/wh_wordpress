<?php
if (!class_exists('whPostObject'))
  require plugin_dir_path(__FILE__) . '/class-post-object.php';

class Main_filtre
{

  public function __construct()
  {
    add_action('init', function () {
    });
    add_action('wp_enqueue_scripts', array(&$this, 'wh_enqueue_script'));
    
    // Crée une shortcode [wh_filter]
    add_shortcode('wh_filter', [&$this, 'sc_render_filter']);
    
    // Autorisation AJAX
    add_action('wp_ajax_wh_get_query_post', [&$this, 'wh_get_query_post']);
    add_action('wp_ajax_nopriv_wh_get_query_post', [&$this, 'wh_get_query_post']);

  }

  public function sc_render_filter($attrs)
  {
    extract(
      shortcode_atts(
        array(
          'type' => null, // Post type slug
          'exclude_tax' => [] // Array of taxonomy slug
        ),
        $attrs
      )
    );
    $post_type = 'post';
    // Vérifier si le shortcode est vide ou non definie
    if (is_null($type) || empty($type)) {
      // S'il est non definie le post type par default sera le 'post'
      $requestType = self::getValue('type', 'post');
      $post_type = trim($requestType);
    } else {
      $post_type = &$type;
    }
    wp_enqueue_style('wh-filter');
    wp_enqueue_script('wh-filter');

    // Tous les contenues du post type
    $posts = self::getPosts($post_type);
    wp_localize_script('wh-filter', 'whOptions', [
      'posts' => $posts,
      'taxonomies' => $this->getTaxonomies($post_type),
      'partials_url' => plugin_dir_url(__FILE__) . 'public/assets/js/partials'
    ]);
    
    // Angular ui route
    return '<div ng-app="filterApp"><ui-view>Chargement...</ui-view></div>';
  }

  public function wh_get_query_post()
  {
    $args = [];
  }

  private static function getPosts($ptype)
  {
    $allPosts = [];
    $object_post = get_option(POST_OPTION, null);
    // Verifier que le post type est enregistrer dans l'option
    if (!is_null($object_post)) {
      if (post_type_exists($ptype)) {
        $args = [
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'post_type' => $ptype
        ];

        $posts = get_posts($args);
        foreach ($posts as $post) {
          array_push($allPosts, new whPostObject($post));
        }
        return $allPosts;
      }
    } else {
      return [];
    }
  }

  private function getTaxonomies($post_type)
  {
    $allTaxonomies = [];
    // @url https://codex.wordpress.org/Function_Reference/get_object_taxonomies
    $taxonomy_slug = get_object_taxonomies($post_type, 'objects');
    foreach ($taxonomy_slug as $slug => $wp_taxonomie) :
      $type = $this->get_taxonomy_type_field($post_type, $slug);
      $allTaxonomies[] = [
        'label' => $wp_taxonomie->label,
        'taxonomie' => $slug,
        'type' => $type,
        'terms' => get_terms($slug, array(
          'hide_empty' => false,
        ))
      ];
      unset($type);
    endforeach;
    return $allTaxonomies;

  }

  private function get_taxonomy_type_field($post_type, $id_taxo)
  {
    $Taxonomies = get_option($post_type, false);
    //print_r($Taxonomies->getTabTaxonomie());
    if (!$Taxonomies) return 'text'; // Type de champ par default: text (input)
    $Taxonomies = $Taxonomies->getTabTaxonomie();
    $taxonomie = array_filter(
      $Taxonomies,
      function ($tabT) use ($post_type, $id_taxo) {
        return $tabT->getId_post() === $post_type && $tabT->getId_taxo() === $id_taxo;
      }
    );
    $resolve = reset($taxonomie);
    return $resolve->filter_field;
  }

  // Récuperer la valeur d'une requete de type GET ou POST
  public static function getValue($name, $def = false)
  {
    if (!isset($name) || empty($name) || !is_string($name)) {
      return $def;
    }
    $returnValue = isset($_POST[$name]) ? trim($_POST[$name]) : (isset($_GET[$name]) ? trim($_GET[$name]) : $def);
    $returnValue = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($returnValue)));
    return !is_string($returnValue) ? $returnValue : stripslashes($returnValue);
  }

  public function wh_enqueue_script()
  {
    // register scripts
    wp_register_style('uikit', plugin_dir_url(__FILE__) . 'public/assets/css/uikit.css');
    wp_register_style('wh-filter', plugin_dir_url(__FILE__) . 'public/assets/css/filter.css', ['uikit'], '0.0.1');

    wp_register_script('angular-sanitize', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular-sanitize.min.js', [], '1.7.2', true);
    wp_register_script('angular-messages', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular-messages.min.js', [], '1.7.2', true);
    wp_register_script('angular-aria', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular-aria.min.js', [], '1.7.2', true);
    wp_register_script('angular-cookies', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular-cookies.min.js', [], '1.7.2', true);
    wp_register_script('angular-ui-route', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular-ui-router.js', [], '1.7.2', true);
    wp_register_script('angular', plugin_dir_url(__FILE__) . 'public/libs/angularjs/angular.js', [], '1.7.2', true);
    wp_register_script('uikit', plugin_dir_url(__FILE__) . 'public/assets/js/uikit.js', [], '3.0.0-rc.15', true);
    wp_register_script('wh-filter', plugin_dir_url(__FILE__) . 'public/assets/js/front-end.js', [
      'angular',
      'angular-sanitize',
      'angular-messages',
      'angular-aria',
      'angular-ui-route',
      'underscore', // underscore.js (http://underscorejs.org)
      'uikit'
    ], '0.0.1', true);

  }


}


<?php

namespace WpGraphQLCrb;

/**
 * Load composer dependencies.
 */
if (file_exists('../vendor/autoload.php')) {
  require_once '../vendor/autoload.php';
}

use Carbon_Fields\Container\Container as CrbContainer;
use Carbon_Fields\REST_API\Decorator;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQL\Model\Post;
use WPGraphQL\Model\Term;
use WPGraphQL\Model\User;
use WPGraphQL\Model\Comment;

class Container
{
  private static $is_first_time = true;

  private static $is_first_time_theme_options = true;

  public function __construct(CrbContainer $container)
  {
    $this->container = $container;
    $this->fields = $this->getFields();
    \add_action('graphql_register_types', [$this, 'graphqlRegisterTypes']);
  }

  static public function register(CrbContainer $container)
  {
    return new Self($container);
  }

  private function registerField(Field $field)
  {
    $roots = $this->container->type === 'theme_options' ? ['Crb_ThemeOptions'] : $this->getGraphQLRoot();
    $field_name = $field->getBaseName();
    $options = [
      'type' => $field->getType($field),
      'description' => $field->getDescription($field),
      'resolve' => $this->getGraphQLResolver($field),
    ];

    foreach ($roots as $root) {
      register_graphql_field($root, $field_name, $options);
    }
  }

  public function graphqlRegisterTypes()
  {
    if (Container::$is_first_time) {
      Container::$is_first_time = false;
      Container::registerStaticObjectTypes();
    }

    if ($this->container->type === 'theme_options' && Container::$is_first_time_theme_options) {
      Container::$is_first_time_theme_options = false;
      Container::registerStaticThemeOptionObjectTypes();
    }

    $this->registerFields();
  }

  private function registerFields()
  {
    foreach ($this->fields as $field) {
      $this->registerField($field);
    }
  }

  static function registerStaticThemeOptionObjectTypes()
  {
    register_graphql_object_type(
        'Crb_ThemeOptions', [
        'description' => \__("All the Carbon Field Theme Options", 'app'),
        'fields' => [],
      ]
    );

    register_graphql_field(
      'RootQuery',
      'crb_ThemeOptions',
      [
        'type' => 'Crb_ThemeOptions',
        'resolve' => function ($src) {
          return [];
        }
      ]
    );
  }

  static function registerStaticObjectTypes()
  {
    register_graphql_object_type('Crb_Select', [
      'description' => \__("The selected option/radio", 'app'),
      'fields' => [
        'label' => [
          'type' => 'String',
          'description' => \__('The label of the option', 'app'),
        ],
        'value' => [
          'type' => 'String',
          'description' => \__('The value of the option', 'app'),
        ],
        'id' => [
          'type' => 'String',
          'description' => \__('The value of the option', 'app'),
        ],
      ],
    ]);

    register_graphql_object_type('Crb_Set', [
      'description' => \__("The option/radio", 'app'),
      'fields' => [
        'label' => [
          'type' => 'String',
          'description' => \__('The label of the option', 'app'),
        ],
        'value' => [
          'type' => 'Boolean',
          'description' => \__('The value indicates if the option is selected or not', 'app'),
        ],
        'id' => [
          'type' => 'String',
          'description' => \__('The id of the option', 'app'),
        ],
      ],
    ]);
  }

  public function getGraphQLResolver(Field $field)
  {
    $resolver = $this->getResolver($field);

    $field_resolver = $field->getResolver();

    return $resolver($field_resolver);
  }

  private function getResolver(Field $field)
  {
    return function ($cb) use ($field) {
      switch ($this->container->type) {
        case 'post_meta':
          return function (Post $post, $args, AppContext $context, ResolveInfo $info) use ($field, $cb) {
            $value = carbon_get_post_meta($post->ID, $field->getBaseName());
            return $cb($value, $field, $this, $args, $context, $info);
          };

        case 'term_meta':
          return function (Term $term, $args, AppContext $context, ResolveInfo $info) use ($field, $cb) {
            $value = carbon_get_term_meta($term->term_id, $field->getBaseName());
            return $cb($value, $field, $this, $args, $context, $info);
          };

        case 'user_meta':
          return function (User $user, $args, AppContext $context, ResolveInfo $info) use ($field, $cb) {
            $value = carbon_get_user_meta($user->userId, $field->getBaseName());
            return $cb($value, $field, $this, $args, $context, $info);
          };

        case 'comment_meta':
          return function (Comment $comment, $args, AppContext $context, ResolveInfo $info) use ($field, $cb) {
            $value = carbon_get_comment_meta($comment->databaseId, $field->getBaseName());
            return $cb($value, $field, $this, $args, $context, $info);
          };

        case 'theme_options':
          return function ($_, $args, AppContext $context, ResolveInfo $info) use ($field, $cb) {
            $value = carbon_get_theme_option($field->getBaseName());
            return $cb($value, $field, $this, $args, $context, $info);
          };

        default:
          return function () use ($cb) {
            return $cb();
          };
      }
    };
  }

  private function getGraphQLRoot()
  {
    $context = $this->container->type;
    $type_callable = array(Decorator::class, "get_{$context}_container_settings");

    if (!is_callable($type_callable)) {
      return [];
    }

    $types = call_user_func($type_callable, $this->container);

    if (!is_array($types)) {
      $types = [$types];
    }

    $roots = array_reduce($types, function ($graphql_types, $type) {
      switch ($this->container->type) {
        case 'post_meta':
          $graphql_type = $this->getGraphQLPostTypeRoot($type);
          break;
          
        case 'term_meta':
          $graphql_type = $this->getGraphQLTermTypeRoot($type);
          break;
          
        case 'user_meta':
          $graphql_type = 'User';
          break;

        case 'comment_meta':
          $graphql_type = 'Comment';
          break;

        default:
          $graphql_type = 'Post';
      }

      if(isset($graphql_type)) {
        $graphql_types[] = $graphql_type;
      }

      return $graphql_types;
    }, []);

    return $roots;
  }

  private function getGraphQLPostTypeRoot(String $type)
  {
    $post_type_object = \get_post_type_object($type);

    $graphql_type = isset($post_type_object->graphql_single_name) ? $post_type_object->graphql_single_name : null;

    return $graphql_type;
  }

  private function getGraphQLTermTypeRoot(String $type)
  {
    $taxonomy_object = \get_taxonomy($type);

    $graphql_type = isset($taxonomy_object->graphql_single_name) ? $taxonomy_object->graphql_single_name : null;

    return $graphql_type;
  }

  private function getFields()
  {
    $graphql_fields = array_map(function ($field) {
      return Field::create($field);
    }, $this->container->get_fields());

    return array_filter($graphql_fields, function (Field $field) {
      return $field->isCompatible();
    });
  }
}

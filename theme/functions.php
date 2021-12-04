<?php

#
# Add Theme Options in Admin Page
#
# WpGraphQLCrb (from matepaiva/wp-graphql-crb) registers the fields in WPGraphQL
# Carbon_Fields (from htmlburger/carbon-fields) registers custom fields in WordPress
#

use WpGraphQLCrb\Container as WpGraphQLCrbContainer;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function() {
    WpGraphQLCrbContainer::register(
        Container::make('theme_options', __('IPCC - Página Inicial', 'app'))
            ->set_icon('dashicons-admin-home')
            ->set_page_menu_position(4)
            ->add_fields([
                Field::make('separator', 'crb_separator_header', 'Cabeçalho'),
                Field::make('html', 'crb_header_info')
                    ->set_html('Título e Subtítulo devem ser definidos em Configurações Gerais.'),
                Field::make('image', 'logo', 'Logo')
                    ->set_value_type('url'),

                Field::make('separator', 'crb_separator_banners', 'Banners'),
                Field::make('complex', 'banners', '')
                    ->add_fields([
                        Field::make('image', 'image', 'Imagem')
                            ->set_value_type('url'),
                        Field::make('association', 'page', 'Página')
                            ->set_types([[
                                'type' => 'post',
                                'post_type' => 'page',
                            ]])
                            ->set_min(1)
                            ->set_max(1),
                    ]),

                Field::make('separator', 'crb_separator_welcome', 'Saudação'),
                Field::make('text', 'welcome-title', 'Título')
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                Field::make('text', 'welcome-subtitle', 'Subtítulo')
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
                Field::make('image', 'welcome-video', 'Vídeo')
                    ->set_type(['video'])
                    ->set_value_type('url'),

                Field::make('separator', 'crb_separator_about', 'Sobre Nós'),
                Field::make('complex', 'about-us', '')
                    ->add_fields([
                        Field::make('text', 'title', 'Título'),
                        Field::make('rich_text', 'content', 'Texto'),
                        Field::make('image', 'image', 'Imagem')
                            ->set_value_type('url'),
                        Field::make('complex', 'actions', 'Botões')
                            ->add_fields([
                                Field::make('text', 'text', 'Texto'),
                                Field::make('association', 'page', 'Página')
                                    ->set_types([[
                                        'type' => 'post',
                                        'post_type' => 'page',
                                    ]])
                                    ->set_min(1)
                                    ->set_max(1),
                            ])
                    ]),

                Field::make('separator', 'crb_separator_groups', 'Ministérios'),
                Field::make('complex', 'groups', '')
                    ->add_fields([
                        Field::make('text', 'name', 'Nome'),
                        Field::make('image', 'image', 'Imagem')
                            ->set_value_type('url'),
                        Field::make('association', 'page', 'Página')
                            ->set_types([[
                                'type' => 'post',
                                'post_type' => 'page',
                            ]])
                            ->set_min(1)
                            ->set_max(1),
                    ]),

                Field::make('separator', 'crb_separator_contact', 'Contato'),
                Field::make('text', 'contact-whatsapp', 'Whatsapp')
                    ->set_default_value('(99) 99999-9999'),
                Field::make('text', 'contact-phone', 'Telefone')
                    ->set_default_value('(99) 99999-9999'),
                Field::make('textarea', 'contact-location', 'Localização')
                    ->set_rows(2)
                    ->set_default_value(str_replace("<br />", "\n", 'Rua Sem Nome, S/N<br />Bairro, Cidade - UF')),
                Field::make('text', 'contact-email', 'Email')
                    ->set_default_value('email@email.com'),

                Field::make('separator', 'crb_separator_footer', 'Rodapé'),
                Field::make('text', 'footer-first-title', 'Rodapé 1 - Título')
                    ->set_default_value('Título'),
                Field::make('textarea', 'footer-first', 'Rodapé 1 - Texto')
                    ->set_rows(3)
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                Field::make('text', 'footer-second-title', 'Rodapé 2 - Título')
                    ->set_default_value('Título'),
                Field::make('textarea', 'footer-second', 'Rodapé 2')
                    ->set_rows(3)
                    ->set_default_value(str_replace("<br />", "\n", '09:00 – Culto Matutino<br />10:00 – Escola Dominical<br />18:30 – Culto Noturno')),
                Field::make('text', 'social-youtube', 'Redes Sociais: Link do Youtube'),
                Field::make('text', 'social-instagram', 'Redes Sociais: Link do Instagram'),
                Field::make('text', 'social-facebook', 'Redes Sociais: Link do Facebook'),
                Field::make('text', 'social-spotify', 'Redes Sociais: Link do Spotify'),
            ])
    );
});

add_action('after_setup_theme', function() {
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
});

#
# Include generated script and style in theme markup
#

add_action('wp_enqueue_scripts', function() {
    # insert css and javascript
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/dist/index.css');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/dist/index.js', array(), null, true);
});

#
# Add support for Sermon Manager's custom post type and taxonomies in WPGraphQL
#

add_filter('register_post_type_args', function($args, $post_type) {
    if ($post_type === 'wpfc_sermon') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'sermon';
        $args['graphql_plural_name'] = 'sermons';
    }

    return $args;
}, 10, 2);

add_filter('register_taxonomy_args', function($args, $taxonomy) {
    if ($taxonomy === 'wpfc_preacher') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'preacher';
        $args['graphql_plural_name'] = 'preachers';

    } else if ($taxonomy === 'wpfc_sermon_series') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'sermonSerie';
        $args['graphql_plural_name'] = 'sermonSeries';

    } else if ($taxonomy === 'wpfc_sermon_topics') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'sermonTopic';
        $args['graphql_plural_name'] = 'sermonTopics';

    } else if ($taxonomy === 'wpfc_service_type') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'serviceType';
        $args['graphql_plural_name'] = 'serviceTypes';

    } else if ($taxonomy === 'wpfc_bible_book') {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'bibleBook';
        $args['graphql_plural_name'] = 'bibleBooks';
    }

    return $args;
}, 10, 2);

# manually include sermon series' image field
add_action('graphql_register_types', function() {
    register_graphql_field('SermonSerie', 'image', [
        'type' => 'String',
        'description' => 'Sermon series image',
        'resolve' => function($source, $args, $context, $info) {
            return get_sermon_series_image_url($source->term_id, 'large');
        }
    ]);
});

?>

<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WpGraphQLCrb\Container as WpGraphQLCrbContainer;

add_action('after_setup_theme', function () {
    require_once(__DIR__ . '/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
});


add_action('carbon_fields_register_fields', function () {
    WpGraphQLCrbContainer::register(
        Container::make('theme_options', __('IPCC', 'app'))
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

                Field::make('separator', 'crb_separator_banner_standalone_page', 'Banner (página avulsa)'),
                Field::make('image', 'banner_standalone_page', 'Imagem')
                    ->set_value_type('url'),

                Field::make('separator', 'crb_separator_welcome', 'Saudação'),
                Field::make('text', 'welcome_title', 'Título')
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                Field::make('text', 'welcome_subtitle', 'Subtítulo')
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
                Field::make('image', 'welcome_video', 'Vídeo')
                    ->set_type(['video'])
                    ->set_value_type('url'),

                Field::make('separator', 'crb_separator_about', 'Sobre Nós'),
                Field::make('complex', 'about_us', '')
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
                Field::make('text', 'contact_whatsapp', 'Whatsapp')
                    ->set_default_value('(99) 99999-9999'),
                Field::make('text', 'contact_phone', 'Telefone')
                    ->set_default_value('(99) 99999-9999'),
                Field::make('textarea', 'contact_location', 'Localização')
                    ->set_rows(2)
                    ->set_default_value(str_replace("<br />", "\n", 'Rua Sem Nome, S/N<br />Bairro, Cidade - UF')),
                Field::make('text', 'contact_email', 'Email')
                    ->set_default_value('email@email.com'),

                Field::make('separator', 'crb_separator_footer', 'Rodapé'),
                Field::make('text', 'footer_first_title', 'Rodapé 1 - Título')
                    ->set_default_value('Título'),
                Field::make('textarea', 'footer_first', 'Rodapé 1 - Texto')
                    ->set_rows(3)
                    ->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                Field::make('text', 'footer_second_title', 'Rodapé 2 - Título')
                    ->set_default_value('Título'),
                Field::make('textarea', 'footer_second', 'Rodapé 2')
                    ->set_rows(3)
                    ->set_default_value(str_replace("<br />", "\n", '09:00 – Culto Matutino<br />10:00 – Escola Dominical<br />18:30 – Culto Noturno')),
                Field::make('text', 'social_youtube', 'Redes Sociais: Link do Youtube'),
                Field::make('text', 'social_instagram', 'Redes Sociais: Link do Instagram'),
                Field::make('text', 'social_facebook', 'Redes Sociais: Link do Facebook'),
                Field::make('text', 'social_spotify', 'Redes Sociais: Link do Spotify'),

                Field::make('separator', 'crb_separator_sermons', 'Séries de Sermões'),
                Field::make('complex', 'sermon_series', '')
                    ->add_fields([
                        Field::make('text', 'title', 'Título'),
                        Field::make('image', 'image', 'Imagem')
                            ->set_value_type('url'),
                        Field::make('text', 'url', 'Link para playlist da série')
                    ]),
            ])
    );
});

#
# Include generated script and style in theme markup
#

add_action('wp_enqueue_scripts', function () {
    # insert css and javascript
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/dist/index.css');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/dist/index.js', array(), null, true);
});

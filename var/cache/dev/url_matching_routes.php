<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/music/insertar' => [[['_route' => 'insertar_cancion', '_controller' => 'App\\Controller\\MusicController::insertar'], null, null, null, false, false, null]],
        '/music/insertarConArtista' => [[['_route' => 'insertar_cancion_con_artista', '_controller' => 'App\\Controller\\MusicController::insertarConProvincia'], null, null, null, false, false, null]],
        '/music/insertarSinArtista' => [[['_route' => 'insertar_cancion_sin_provincia', '_controller' => 'App\\Controller\\MusicController::insertarSinProvincia'], null, null, null, false, false, null]],
        '/music/nuevo' => [[['_route' => 'nuevo_cancion', '_controller' => 'App\\Controller\\MusicController::nuevo'], null, null, null, false, false, null]],
        '/music' => [[['_route' => 'app_music', '_controller' => 'App\\Controller\\MusicController::index'], null, null, null, false, false, null]],
        '/page' => [[['_route' => 'app_page', '_controller' => 'App\\Controller\\PageController::index'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'inicio', '_controller' => 'App\\Controller\\PageController::inicio'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/music/(?'
                    .'|editar/([^/]++)(*:194)'
                    .'|delete/([^/]++)(*:217)'
                    .'|([^/]++)(*:233)'
                    .'|buscar/([^/]++)(*:256)'
                    .'|update/([^/]++)/([^/]++)(*:288)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        194 => [[['_route' => 'editar_cancion', '_controller' => 'App\\Controller\\MusicController::editar'], ['codigo'], null, null, false, true, null]],
        217 => [[['_route' => 'eliminar_cancion', '_controller' => 'App\\Controller\\MusicController::delete'], ['id'], null, null, false, true, null]],
        233 => [[['_route' => 'ficha_cancion', '_controller' => 'App\\Controller\\MusicController::ficha'], ['codigo'], null, null, false, true, null]],
        256 => [[['_route' => 'buscar_cancion', '_controller' => 'App\\Controller\\MusicController::buscar'], ['texto'], null, null, false, true, null]],
        288 => [
            [['_route' => 'modificar_contacto', '_controller' => 'App\\Controller\\MusicController::update'], ['id', 'nombre'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

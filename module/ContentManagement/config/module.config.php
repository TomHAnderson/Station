<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'ContentManagement\Controller\Page' => 'ContentManagement\Controller\PageController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__.'/../view',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'getPages' => 'ContentManagement\View\Helper\GetPages',
        ),
    ),

    'router' => array(
        'routes' => array(
            'page-by-id' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/page/[:id]',
                    'defaults' => array(
                        'controller'    => 'ContentManagement\Controller\Page',
                        'action'        => 'index',
                    ),
                ),
            ),
            'page' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/page',
                    'defaults' => array(
                        'controller'    => 'ContentManagement\Controller\Page',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:url-identifier',
                            'defaults' => array(
                                'controller'    => 'ContentManagement\Controller\Page',
                                'action'        => 'detail',
                            ),
                            'constraints' => array(
#                                'url-identifier' => '^(!create)|(!edit)$',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/create',
                            'defaults' => array(
                                'controller'    => 'ContentManagement\Controller\Page',
                                'action'        => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/edit/:url-identifier',
                            'defaults' => array(
                                'controller'    => 'ContentManagement\Controller\Page',
                                'action'        => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/delete/:url-identifier',
                            'defaults' => array(
                                'controller'    => 'ContentManagement\Controller\Page',
                                'action'        => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

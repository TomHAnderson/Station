<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Station\Controller\Member' => 'Station\Controller\MemberController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'member' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/member',
                    'defaults' => array(
                        'controller'    => 'Station\Controller\Member',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:id',
                            'defaults' => array(
                                'controller'    => 'Station\Controller\Member',
                                'action'        => 'detail',
                            ),
                        ),
                    ),
                    'refresh' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/refresh',
                            'defaults' => array(
                                'controller'    => 'Station\Controller\Member',
                                'action'        => 'refresh',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/view/:id',
                            'defaults' => array(
                                'controller'    => 'Station\Controller\Member',
                                'action'        => 'view',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__.'/../view',
        ),
    ),
);

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
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/member',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Station\Controller',
                        'controller'    => 'Member',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'refresh' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/refresh',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Station\Controller',
                                'controller'    => 'Member',
                                'action'        => 'refresh',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/view/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Station\Controller',
                                'controller'    => 'Member',
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

<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\MeetupGroup' => 'Admin\Controller\MeetupGroupController',
            'Admin\Controller\Event' => 'Admin\Controller\EventController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__.'/../view',
        ),
    ),

    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller'    => 'Admin\Controller\Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'meetup-group' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/meetup-group/:id',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\MeetupGroup',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'event-refresh-all' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/event/refresh-all',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Event',
                                        'action'        => 'refreshAll',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

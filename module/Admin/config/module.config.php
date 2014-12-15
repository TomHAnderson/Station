<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\MeetupGroup' => 'Admin\Controller\MeetupGroupController',
            'Admin\Controller\Event' => 'Admin\Controller\EventController',
            'Admin\Controller\Venue' => 'Admin\Controller\VenueController',
            'Admin\Controller\Sponsor' => 'Admin\Controller\SponsorController',
        ),
    ),

    'form_elements' => array(
        'factories' => array(
            'SponsorSelect' => 'Admin\Form\Element\SponsorSelectFactory',
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
                    'event' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/event/:id',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\Event',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'sponsor' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/sponsor',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\Sponsor',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'create' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/create',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Sponsor',
                                        'action'        => 'create',
                                    ),
                                ),
                            ),
                            'detail' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Sponsor',
                                        'action'        => 'detail',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/edit',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Sponsor',
                                        'action'        => 'edit',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/delete',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Sponsor',
                                        'action'        => 'delete',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'venue' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/venue',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\Venue',
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
                                        'controller'    => 'Admin\Controller\Venue',
                                        'action'        => 'detail',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/edit',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Venue',
                                        'action'        => 'edit',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
                        ),
                    ),
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

<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\MeetupGroup' => 'Admin\Controller\MeetupGroupController',
            'Admin\Controller\Event' => 'Admin\Controller\EventController',
            'Admin\Controller\Venue' => 'Admin\Controller\VenueController',
            'Admin\Controller\Sponsor' => 'Admin\Controller\SponsorController',
            'Admin\Controller\SponsorContact' => 'Admin\Controller\SponsorContactController',
            'Admin\Controller\SponsorContribution' => 'Admin\Controller\SponsorContributionController',
            'Admin\Controller\VenueQuestion' => 'Admin\Controller\VenueQuestionController',
        ),
    ),

    'form_elements' => array(
        'factories' => array(
            'SponsorSelect' => 'Admin\Form\Element\SponsorSelectFactory',
            'MeetupGroupSelect' => 'Admin\Form\Element\MeetupGroupSelectFactory',
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
                    // This route is denied by default and the action does not exist
                    // Use for a cleaner tree route stack below
                    'event' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/event',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\Event',
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
                                        'controller'    => 'Admin\Controller\Event',
                                        'action'        => 'detail',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    // This route is denied by default and the action does not exist
                    // Use for a cleaner tree route stack below
                    'sponsor-contact' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/sponsor-contact',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\SponsorContact',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'create' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/create/:sponsor_id',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContact',
                                        'action'        => 'create',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/edit/:id',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContact',
                                        'action'        => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/delete/:id',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContact',
                                        'action'        => 'delete',
                                    ),
                                ),
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
                    'venue-question' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/venue-question',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\VenueQuestion',
                                'action'        => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'create' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:venue_id/create',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\VenueQuestion',
                                        'action'        => 'create',
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
                                        'controller'    => 'Admin\Controller\VenueQuestion',
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
                                        'controller'    => 'Admin\Controller\VenueQuestion',
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
                            'question' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/question',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\Venue',
                                        'action'        => 'question',
                                    ),
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                ),
                            ),
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
                    'sponsor-contribution' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/sponsor-contribution',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\SponsorContribution',
                                'action'        => 'detail',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'detail' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContribution',
                                        'action'        => 'detail',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/edit',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContribution',
                                        'action'        => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/delete',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\SponsorContribution',
                                        'action'        => 'delete',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'meetup-group' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/meetup-group',
                            'defaults' => array(
                                'controller'    => 'Admin\Controller\MeetupGroup',
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
                                        'controller'    => 'Admin\Controller\MeetupGroup',
                                        'action'        => 'detail',
                                    ),
                                ),
                            ),
                            'sponsor-contribution' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/sponsor-contribution',
                                    'defaults' => array(
                                        'controller'    => 'Admin\Controller\MeetupGroup',
                                        'action'        => 'sponsorContribution',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'create' => array(
                                        'type'    => 'Segment',
                                        'options' => array(
                                            'route'    => '/create[/:event_id]',
                                            'defaults' => array(
                                                'controller'    => 'Admin\Controller\SponsorContribution',
                                                'action'        => 'create',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'event-refresh-all' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/:id/event/refresh-all',
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

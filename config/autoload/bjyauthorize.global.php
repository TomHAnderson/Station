<?php

return [
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'MeetupProviderIdentity',

        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Db\Entity\Role',
            ),
        ),

        'rule_providers' => [
            'BjyAuthorize\Provider\Rule\Config' => [
                'allow' => [
                    [['administrator'], 'administration', 'access'],
                ],
#                'deny' => [
#                ],
            ],
        ],

        'resource_providers' => [
            'BjyAuthorize\Provider\Resource\Config' => [
                'report' => [],
                'team' => [],
                'administration' => [],
            ],
        ],

        'unauthorized_strategy' => 'BjyAuthorizeViewRedirectionStrategy',
        'default_role' => 'guest',

        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'home', 'roles' => array('guest')),
                array('route' => 'authentication', 'roles' => array('guest')),
                array('route' => 'authentication/logout', 'roles' => array('member')),
                array('route' => 'authentication/error', 'roles' => array('guest')),

                array('route' => 'page', 'roles' => array('guest')),
                array('route' => 'page/edit', 'roles' => array('administrator')),
                array('route' => 'page/delete', 'roles' => array('administrator')),
                array('route' => 'page-create', 'roles' => array('administrator')),

                array('route' => 'member', 'roles' => array('member')),
                array('route' => 'member/refresh', 'roles' => array('member')),

                # Administration
                array('route' => 'admin', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor/create', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor/detail', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor/edit', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor/delete', 'roles' => array('administrator')),

                array('route' => 'admin/sponsor-contact', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor-contact/create', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor-contact/edit', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor-contact/delete', 'roles' => array('administrator')),

                array('route' => 'admin/meetup-group', 'roles' => array('administrator')),
                array('route' => 'admin/meetup-group/event-refresh-all', 'roles' => array('administrator')),
                array('route' => 'admin/meetup-group/sponsor-contribution', 'roles' => array('administrator')),
                array('route' => 'admin/meetup-group/sponsor-contribution/create', 'roles' => array('administrator')),

                array('route' => 'admin/sponsor-contribution', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor-contribution/edit', 'roles' => array('administrator')),
                array('route' => 'admin/sponsor-contribution/delete', 'roles' => array('administrator')),

                array('route' => 'admin/venue', 'roles' => array('administrator')),
                array('route' => 'admin/venue/detail', 'roles' => array('administrator')),
                array('route' => 'admin/venue/edit', 'roles' => array('administrator')),

                array('route' => 'admin/venue-question/create', 'roles' => array('administrator')),
                array('route' => 'admin/venue-question/edit', 'roles' => array('administrator')),
                array('route' => 'admin/venue-question/delete', 'roles' => array('administrator')),

                array('route' => 'admin/event', 'roles' => array('administrator')),
                array('route' => 'admin/event/edit', 'roles' => array('administrator')),

                array('route' => 'doctrine_orm_module_yuml', 'roles' => array('administrator')),

                array('route' => 'audit', 'roles' => array('administrator')),
                array('route' => 'audit/page', 'roles' => array('administrator')),
                array('route' => 'audit/user', 'roles' => array('administrator')),
                array('route' => 'audit/revisions', 'roles' => array('administrator')),
                array('route' => 'audit/revision-entity', 'roles' => array('administrator')),
                array('route' => 'audit/one-to-many', 'roles' => array('administrator')),
                array('route' => 'audit/association-target', 'roles' => array('administrator')),
                array('route' => 'audit/association-source', 'roles' => array('administrator')),
                array('route' => 'audit/entity', 'roles' => array('administrator')),
                array('route' => 'audit/compare', 'roles' => array('administrator')),

            ),
        ),
    ),
];
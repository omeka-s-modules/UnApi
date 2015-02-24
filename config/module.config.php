<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'UnApi\Controller\Index' => 'UnApi\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack'      => array(
            OMEKA_PATH . '/module/UnApi/view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'unapi-server' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/unapi-server',
                    'defaults' => array(
                        '__NAMESPACE__' => 'UnApi\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
);

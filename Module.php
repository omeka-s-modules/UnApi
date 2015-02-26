<?php
namespace UnApi;

use Omeka\Module\AbstractModule;
use Zend\EventManager\EventInterface;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachListeners(
        SharedEventManagerInterface $sharedEventManager,
        SharedEventManagerInterface $filterManager
    ) {
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.layout',
            function (EventInterface $event) {
                $event->getTarget()->headLink(array(
                    'rel'   => 'unapi-server',
                    'type'  => 'application/xml',
                    'title' => 'unAPI',
                    'href'  => $event->getTarget()->url('unapi'),
                ));
            }
        );
        $filterManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.browse.after',
            function ($arg, EventInterface $event) {
                $items = $event->getTarget()->items;
                foreach ($items as $item) {
                    $arg[] = sprintf('<abbr class="unapi-id" title="%s"></abbr>', $item->id());
                }
                return $arg;
            }
        );
        $filterManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.show.after',
            function ($arg, EventInterface $event) {
                $item = $event->getTarget()->item;
                $arg[] = sprintf('<abbr class="unapi-id" title="%s"></abbr>', $item->id());
                return $arg;
            }
        );
    }
}


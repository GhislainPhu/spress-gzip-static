<?php

namespace GhislainPhu\Spress\Plugin\GzipStatic;

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;

/**
 * Spress Plugin entry point
 *
 * @author Ghislain PHU <contact@ghislainphu.fr>
 */
class SpressGzipStatic implements PluginInterface
{
    /**
     * Initialize plugin: subscribe to events
     *
     * @param EventSubscriber $subscriber
     */
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    /**
     * Get plugin metadatas
     *
     * @return array
     */
    public function getMetas()
    {
        return [
            'name'        => 'ghislainphu/spress-gzip-static',
            'description' => 'Creates a gzipped version of your compiled files.',
            'author'      => 'Ghislain PHU',
            'license'     => 'MIT',
        ];
    }

    /**
     * Extract configuration and override the default DataWriter on startup
     *
     * @param EnvironmentEvent $event The start event
     */
    public function onStart(EnvironmentEvent $event)
    {
        $configValues = $event->getConfigValues();
        $configuration = new Configuration($configValues);

        $event->setConfigValues($configuration->get());
    }
}

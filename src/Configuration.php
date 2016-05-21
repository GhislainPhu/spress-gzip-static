<?php

namespace GhislainPhu\Spress\Plugin\GzipStatic;

/**
 * Configuration
 *
 * @author Ghislain PHU <contact@ghislainphu.fr>
 */
class Configuration
{
    /**
     * Site configuration
     *
     * @var array
     */
    protected $configuration;

    /**
     * Constructor
     *
     * @param array $configuration The whole configuration from config.yml
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Get the whole configuration
     *
     * @return array The configuration
     */
    public function get()
    {
        $configuration = $this->configuration;

        $configuration['gzip_static_compression_level'] = $this->getCompressionLevel();
        $configuration['gzip_static_exclude'] = $this->getExcludedFiles();
        $configuration['gzip_static_extensions'] = $this->getExtensions();

        return $configuration;
    }

    /**
     * Get the compression level
     *
     * @return int The compression level (-1 to 9)
     */
    public function getCompressionLevel()
    {
        if (!isset($this->configuration['gzip_static_compression_level'])) {
            return -1;
        }

        return filter_var(
            $this->configuration['gzip_static_compression_level'],
            FILTER_VALIDATE_INT,
            array('options' => array('default' => -1, 'min_range' => -1, 'max_range' => 9))
        );
    }

    /**
     * Get the list of excluded files
     *
     * @return array The list of files to exclude
     */
    public function getExcludedFiles()
    {
        return $this->getStringArray('gzip_static_exclude');
    }

    /**
     * Get the list of file extensions to process
     *
     * @return array The list of extensions
     */
    public function getExtensions()
    {
        return $this->getStringArray('gzip_static_extensions');
    }

    /**
     * Retrieve an array of string from configuration
     *
     * @param string $key The name of the configuration option
     */
    protected function getStringArray($key)
    {
        if (isset($this->configuration[$key]) && is_array($this->configuration[$key])) {
            return array_filter($this->configuration[$key], 'is_string');
        }

        return array();
    }
}

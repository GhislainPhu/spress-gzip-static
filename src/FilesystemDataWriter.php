<?php

namespace GhislainPhu\Spress\Plugin\GzipStatic;

use \Yosymfony\Spress\Core\DataWriter;
use Yosymfony\Spress\Core\DataSource\ItemInterface;

/**
 * FilesystemDataWriter
 *
 * @author Ghislain PHU <contact@ghislainphu.fr>
 */
class FilesystemDataWriter extends DataWriter\FilesystemDataWriter
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
     * @param DataWriter\FilesystemDataWriter $parent        Original DataWriter
     * @param Configuration                   $configuration Configuration object
     */
    public function __construct(DataWriter\FilesystemDataWriter $parent, Configuration $configuration)
    {
        parent::__construct($parent->filesystem, $parent->outputDir);

        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function write(ItemInterface $item)
    {
        parent::write($item);

        if ($this->isWritable($item) === false) {
            return;
        }

        $writtenPath = $item->getPath(ItemInterface::SNAPSHOT_PATH_PERMALINK);
        $writtenExtension = pathinfo($writtenPath, PATHINFO_EXTENSION);

        $writeGzip = strlen($writtenPath) !== 0;
        $writeGzip = $writeGzip && !in_array($item->getId(), $this->configuration->getExcludedFiles());
        $writeGzip = $writeGzip && in_array($writtenExtension, $this->configuration->getExtensions());

        if ($writeGzip) {
            $this->filesystem->dumpFile(
                $this->composeOutputPath($writtenPath . '.gz'),
                gzencode($item->getContent(), $this->configuration->getCompressionLevel())
            );
        }
    }
}

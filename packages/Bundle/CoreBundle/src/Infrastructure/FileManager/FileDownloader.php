<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\FileManager;

use League\Flysystem\FilesystemInterface;

final class FileDownloader
{
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $defaultStorage)
    {
        $this->filesystem = $defaultStorage;
    }

    public function __invoke(string $encodedFilename): File
    {
        return new File(
            $this->filesystem->readStream($encodedFilename),
            $this->filesystem->getMimetype($encodedFilename)
        );
    }
}

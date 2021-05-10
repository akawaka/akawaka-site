<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\FileManager;

use League\Flysystem\FilesystemOperator;

final class FileDownloader
{
    public function __construct(
        private FilesystemOperator $filesystem
    ) {
    }

    public function __invoke(string $encodedFilename): File
    {
        return new File(
            $this->filesystem->readStream($encodedFilename),
            $this->filesystem->mimeType($encodedFilename)
        );
    }
}

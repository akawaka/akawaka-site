<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\FileManager;

use League\Flysystem\FilesystemInterface;
use Ramsey\Uuid\Uuid;

final class FileUploader
{
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $defaultStorage)
    {
        $this->filesystem = $defaultStorage;
    }

    public function __invoke(string $file, string $filename): string
    {
        $filename = \Safe\sprintf('%s-%s', Uuid::uuid4()->toString(), $filename);

        $stream = \Safe\fopen($file, 'rb');
        $this->filesystem->writeStream($filename, $stream);
        \Safe\fclose($stream);

        return $filename;
    }
}

<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\FileManager;

use League\Flysystem\FilesystemOperator;
use Ramsey\Uuid\Uuid;

final class FileUploader
{
    public function __construct(
        private FilesystemOperator $filesystem
    ) {
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

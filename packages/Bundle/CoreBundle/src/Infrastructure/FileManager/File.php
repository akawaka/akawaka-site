<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\FileManager;

final class File
{
    /**
     * @var resource|bool
     */
    private $stream;

    private string $mimeType;

    /**
     * @param resource|bool $stream
     */
    public function __construct($stream, string $mimeType)
    {
        $this->stream = $stream;
        $this->mimeType = $mimeType;
    }

    /**
     * @return resource
     */
    public function getStream()
    {
        return $this->stream;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }
}

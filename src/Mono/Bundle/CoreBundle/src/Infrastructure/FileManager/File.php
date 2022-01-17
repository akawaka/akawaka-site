<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\FileManager;

final class File
{
    /**
     * @var bool|resource
     */
    private $stream;

    private string $mimeType;

    /**
     * @param bool|resource $stream
     */
    public function __construct($stream, string $mimeType)
    {
        $this->stream = $stream;
        $this->mimeType = $mimeType;
    }

    /**
     * @return bool|resource
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

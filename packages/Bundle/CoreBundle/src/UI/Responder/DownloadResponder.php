<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\UI\Responder;

use Black\Component\Core\Infrastructure\FileManager\FileDownloader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class DownloadResponder
{
    private FileDownloader $downloader;

    public function __construct(FileDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function __invoke(
        string $encodedFilename,
        string $filename,
        int $status = 200,
        array $headers = []
    ): Response {
        $file = ($this->downloader)($encodedFilename);

        $response = new StreamedResponse(function () use ($file): void {
            \Safe\stream_copy_to_stream($file->getStream(), \Safe\fopen('php://output', 'wb'));
        });

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', $file->getMimeType());

        return $response;
    }
}

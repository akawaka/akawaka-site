<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\UI\Responder;

use Mono\Bundle\CoreBundle\Infrastructure\FileManager\FileDownloader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class DownloadResponder
{
    public function __construct(
        private FileDownloader $downloader
    ) {
    }

    /**
     * @param array<string, string> $headers
     */
    public function __invoke(
        string $encodedFilename,
        string $filename,
        int $status = 200,
        array $headers = []
    ): Response {
        $file = ($this->downloader)($encodedFilename);

        $response = new StreamedResponse(function () use ($file): void {
            // @phpstan-ignore-next-line
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

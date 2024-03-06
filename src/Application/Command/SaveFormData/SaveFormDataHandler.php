<?php

namespace App\Application\Command\SaveFormData;

use App\Domain\Event\FormDataWasSaved;
use Cocur\Slugify\Slugify;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class SaveFormDataHandler
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private string $dataDirectory
    ) {
    }

    public function __invoke(SaveFormDataCommand $command): void
    {
        $uuid = Uuid::v4();
        $slugify = new Slugify();

        $filePath = sprintf('%s/%s_%s.%s',
            $this->dataDirectory,
            $uuid->jsonSerialize(),
            $slugify->slugify($command->attachment->getClientOriginalName()),
            $command->attachment->getClientOriginalExtension()
        );

        $filesystem = new Filesystem();

        $filesystem->rename($command->attachment->getPathname(), $filePath);

        $this->eventDispatcher->dispatch(
            new FormDataWasSaved(
                $uuid,
                $command->name,
                $command->surname,
                $filePath,
                [
                    'originalName' => $command->attachment->getClientOriginalName(),
                    'extension' => $command->attachment->getClientOriginalExtension(),
                    'mimeType' => $command->attachment->getClientMimeType(),
                ]
            )
        );
    }
}

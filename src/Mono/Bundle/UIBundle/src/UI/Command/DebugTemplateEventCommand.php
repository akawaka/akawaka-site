<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\UI\Command;

use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlock;
use Mono\Bundle\UIBundle\Infrastructure\Registry\TemplateBlockRegistryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class DebugTemplateEventCommand extends Command
{
    protected static $defaultName = 'mono:debug:template-event';

    public function __construct(
        private TemplateBlockRegistryInterface $templateBlockRegistry
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Debug template events and associated blocks')
            ->addArgument('event', InputArgument::OPTIONAL, 'Template event name', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $eventName = $input->getArgument('event');

        if ($eventName === null) {
            $io->title('List of template events');
            $io->listing(array_keys($this->templateBlockRegistry->all()));

            return 0;
        }

        $io->title(sprintf('Blocks registered for the template event "%s"', $eventName));

        $io->table(
            ['Block name', 'Template', 'Priority', 'Enabled'],
            array_map(
                static function (TemplateBlock $templateBlock): array {
                    return [
                        $templateBlock->getName(),
                        $templateBlock->getTemplate(),
                        $templateBlock->getPriority(),
                        $templateBlock->isEnabled(),
                    ];
                },
                $this->templateBlockRegistry->all()[$eventName] ?? []
            )
        );

        return 0;
    }
}

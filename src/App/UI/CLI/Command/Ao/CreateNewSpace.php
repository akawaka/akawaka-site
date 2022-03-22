<?php

declare(strict_types=1);

namespace App\UI\CLI\Command\Ao;

use App\UI\CLI\Command\CommandNaming;
use App\Context\Admin\Space\Application\Gateway\CreateSpace;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateNewSpace extends Command
{
    public function __construct(
        private CreateSpace\Gateway $gateway
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName(CommandNaming::classToName(self::class))
            ->setDescription('Create a new space for your project')
            ->addArgument('name', InputArgument::REQUIRED, 'Your space name?')
            ->addArgument('code', InputArgument::REQUIRED, 'Your space code?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            ($this->gateway)(
                CreateSpace\Request::fromData($input->getArguments())
            );

            $output->writeln(\Safe\sprintf(
                '<fg=green>Space %s with code %s is created!</>',
                $input->getArgument('name'),
                $input->getArgument('code')
            ));
        } catch (GatewayException $exception) {
            $output->writeln('<fg=red>Error during space creation!</>');

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

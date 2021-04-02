<?php

declare(strict_types=1);

namespace App\UI\CLI\Command;

use Black\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Cms\Application\Gateway\CreateChannel;

final class CreateNewChannel extends Command
{
    protected static $defaultName = 'cms:create-channel';

    private CreateChannel\Gateway $gateway;

    public function __construct(CreateChannel\Gateway $gateway)
    {
        $this->gateway = $gateway;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new channel for your project')
            ->addArgument('name', InputArgument::REQUIRED, 'Your channel name?')
            ->addArgument('code', InputArgument::REQUIRED, 'Your channel code?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = ($this->gateway)(
                CreateChannel\Request::fromData($input->getArguments())
            );

            $output->writeln(\Safe\sprintf(
                '<fg=green>Channel %s with code %s is created!</>',
                $response->data()['name'],
                $response->data()['code']
            ));
        } catch (GatewayException $exception) {
            $output->writeln('<fg=red>Error during channel creation!</>');

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
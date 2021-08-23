<?php

declare(strict_types=1);

namespace App\UI\CLI\Command\Security;

use App\Security\Application\AdminSecurity\Gateway\Register;
use App\UI\CLI\Command\CommandNaming;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateNewAdmin extends Command
{
    public function __construct(
        private Register\Gateway $gateway
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName(CommandNaming::classToName(self::class))
            ->setDescription('Create a new admin for your project')
            ->addArgument('username', InputArgument::REQUIRED, 'Admin username?')
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email?')
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = ($this->gateway)(
                Register\Request::fromData($input->getArguments())
            );

            $output->writeln(\Safe\sprintf(
                '<fg=green>Admin  %s and email %s is created!</>',
                $response->data()['username'],
                $response->data()['email']
            ));
        } catch (GatewayException $exception) {
            $output->writeln('<fg=red>Error during process!</>');

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

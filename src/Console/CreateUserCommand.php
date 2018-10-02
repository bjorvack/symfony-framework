<?php

namespace App\Console;

use App\Command\CreateUser;
use App\CommandHandler\CreateUserHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    /** @var CreateUserHandler */
    private $createUserHandler;

    public function __construct(CreateUserHandler $createUserHandler)
    {
        parent::__construct(null);

        $this->createUserHandler = $createUserHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a user to the database')
            ->addArgument('email', InputArgument::REQUIRED, 'email')
            ->addArgument('password', InputArgument::REQUIRED, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createUserHandler->handle(
            new CreateUser(
                $input->getArgument('email'),
                $input->getArgument('password')
            )
        );

        $output->writeln('<success>Added a new user</success>');
    }
}

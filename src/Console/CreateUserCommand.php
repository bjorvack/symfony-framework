<?php

namespace App\Console;

use App\Command\CreateUser;
use App\CommandHandler\CreateUserHandler;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    /** @var CreateUserHandler */
    private $createUserHandler;

    /** @var RoleRepository */
    private $roleRepository;

    public function __construct(
        CreateUserHandler $createUserHandler,
        RoleRepository $roleRepository
    ) {
        parent::__construct(null);

        $this->createUserHandler = $createUserHandler;
        $this->roleRepository = $roleRepository;
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
                $input->getArgument('password'),
                new ArrayCollection([
                    $this->roleRepository->findOneByName('ROLE_USER')
                ])
            )
        );

        $output->writeln('<success>Added a new user</success>');
    }
}

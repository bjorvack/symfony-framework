<?php

namespace App\Console;

use App\Command\CreateRole;
use App\CommandHandler\CreateRoleHandler;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateRoleCommand extends Command
{
    protected static $defaultName = 'app:create-role';

    /** @var CreateRoleHandler */
    private $createRoleHandler;

    public function __construct(
        CreateRoleHandler $createRoleHandler
    ) {
        parent::__construct(null);

        $this->createRoleHandler = $createRoleHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a role to the database')
            ->addArgument('name', InputArgument::REQUIRED, 'name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createRoleHandler->handle(
            new CreateRole(
                $input->getArgument('name'),
                new ArrayCollection()
            )
        );

        $output->writeln('<success>Added a new role</success>');
    }
}

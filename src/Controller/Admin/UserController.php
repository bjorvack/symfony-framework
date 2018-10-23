<?php

namespace App\Controller\Admin;

use App\Repository\Doctrine\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

class UserController
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Twig_Environment */
    private $twig;

    public function __construct(
        UserRepository $userRepository,
        Twig_Environment $twig
    ) {
        $this->userRepository = $userRepository;
        $this->twig = $twig;
    }

    /**
     * @Route("/users", name="admin_users")
     *
     * @return Response
     *
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function indexAction(): Response
    {
        return new Response(
            $this->twig->render(
                'Admin/User/index.html.twig',
                [
                    'users' => $this->userRepository->findAll()
                ]
            )
        );
    }
}
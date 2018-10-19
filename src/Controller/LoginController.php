<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

class LoginController
{
    /** @var AuthenticationUtils */
    private $authenticationUtils;

    /** var Twig_Environment */
    private $twig;

    public function __construct(
        AuthenticationUtils $authenticationUtils,
        Twig_Environment $twig
    ) {
        $this->authenticationUtils = $authenticationUtils;
        $this->twig = $twig;
    }

    /**
     * @Route("/login", name="login")
     *
     * @return Response
     *
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function loginAction(): Response
    {
        return new Response(
            $this->twig->render(
                'login.html.twig',
                [
                    'error' => $this->authenticationUtils->getLastAuthenticationError(),
                    'last_username' => $this->authenticationUtils->getLastUsername(),
                ]
            )
        );
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Security\LoginFormAuthenticator;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/api/login', name: 'app_api_login', methods: ['POST'])]
    public function apiLogin(Request $request, LoginFormAuthenticator $loginFormAuthenticator): JsonResponse
    {
        // Decode JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Check if the 'username' and 'password' fields exist in the decoded data
        if (!isset($data['username']) || !isset($data['password'])) {
            // Handle missing fields and return an error response
            return new JsonResponse(['error' => 'Missing username or password'], Response::HTTP_BAD_REQUEST);
        }

        $username = $data['username'];
        $password = $data['password'];

        // Use the LoginFormAuthenticator to authenticate the user
        $passport = $loginFormAuthenticator->authenticate($request, $username, $password);

        // You can access the authenticated user from the passport if needed
        $user = $passport->getUser();


        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Authentication successful'], Response::HTTP_OK);
    }


    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

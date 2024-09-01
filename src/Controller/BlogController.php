<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_list')]
    public function list(Request $request): Response
    {
        $routeName = $request->attributes->get('_route');
        $routeParameters = $request->attributes->get('_route_params');
        $allAttributes = $request->attributes->all();

        $signUpPageUrl = $this->generateUrl('sign_up');
        $userProfilePageUrl = $this->generateUrl('user_profile', [
            'username' => 'exampleUser',
        ]);
        $absoluteSignUpPageUrl = $this->generateUrl('sign_up', [], UrlGeneratorInterface::ABSOLUTE_PATH);
        $signUpPageInDutchUrl = $this->generateUrl('sign_up', ['_locale' => 'nl']);


        $blogPosts = [
            ['title' => 'First Post', 'content' => 'Content of the first post'],
            ['title' => 'Second Post', 'content' => 'Content of the second post'],
            ['title' => 'Third Post', 'content' => 'Content of the third post'],
        ];

        return $this->render('blog/list.html.twig', [
            'posts' => $blogPosts,
            'routeName' => $routeName,
            'routeParameters' => $routeParameters,
            'allAttributes' => $allAttributes,
            'signUpPageUrl' => $signUpPageUrl,
            'userProfilePageUrl' => $userProfilePageUrl,
            'absoluteSignUpPageUrl' => $absoluteSignUpPageUrl,
            'signUpPageInDutchUrl' => $signUpPageInDutchUrl,
        ]);
    }
}
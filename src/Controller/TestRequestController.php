<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestRequestController extends AbstractController
{
    #[Route('/test/request', name: 'app_test_request')]
    public function index(): Response
    {
        return $this->render('test_request/index.html.twig', [
            'controller_name' => 'TestRequestController',
        ]);
    }

    #[Route('/test/request/post', name: 'app_test_post')]
    public function post(Request $request): Response
    {
        return $this->json($request->request->get('name'));
    }
}

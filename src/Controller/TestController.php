<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(Request $request): Response
    {
        $data = json_decode($request->getContent());

        return $this->json($data);
    }

    #[Route('api/test/data', name: 'app_test_data',methods:['GET'])]
    public function test_data(ProductRepository $proRep,CategoryRepository $catRepo): Response
    {
        return $this->json($proRep->findAll(),200,[],['groups'=>'product']);
    }
}

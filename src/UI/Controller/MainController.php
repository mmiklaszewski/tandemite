<?php

namespace App\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/form', name: 'form')]
    public function form(): Response
    {
        return $this->render('form.html.twig');
    }

    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        return $this->render('list.html.twig');
    }
}

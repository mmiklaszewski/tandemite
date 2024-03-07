<?php

namespace App\UI\Controller;

use App\Application\Query\GetSavedFormData\GetSavedFormDataQuery;
use App\Application\Query\QueryBus;
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

    #[Route('/list/{page}', name: 'list')]
    public function list(QueryBus $queryBus, int $page = 1): Response
    {
        $collection = $queryBus->handle(
            new GetSavedFormDataQuery(
                3,
                $page,
            )
        );

        return $this->render('list.html.twig', $collection->jsonSerialize());
    }
}

<?php

namespace App\UI\Controller;

use App\Application\Command\CommandBus;
use App\Application\Command\SaveFormData\SaveFormDataCommand;
use App\UI\Input\FormDataInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class FormController extends AbstractController
{
    #[Route('/save-form', name: 'save-form', methods: ['POST'])]
    public function saveForm(
        Request $request,
        ValidatorInterface $validator,
        CommandBus $commandBus,
    ): JsonResponse {
        try {
            $input = FormDataInput::fromRequest($request);

            $errors = $validator->validate($input);

            if (count($errors) > 0) {
                return new JsonResponse('Bad arguments', Response::HTTP_BAD_REQUEST);
            }

            $commandBus->handle(
                SaveFormDataCommand::fromInput($input)
            );

            return new JsonResponse('OK', Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse('Bad request', Response::HTTP_BAD_REQUEST);
        }
    }
}

<?php

namespace Apps\Web\Controller;

use Src\Tracking\Application\UseCase\GetTasksUseCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetTasksController extends Controller
{
    public function __invoke(
        Request $request,
        GetTasksUseCase $useCase
    ): JsonResponse
    {
        return new JsonResponse($useCase->execute(), Response::HTTP_OK);
    }
}

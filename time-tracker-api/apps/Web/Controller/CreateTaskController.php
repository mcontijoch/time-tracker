<?php

declare(strict_types=1);

namespace Apps\Web\Controller;

use Src\Tracking\Application\UseCase\CreateTaskUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskController extends Controller
{
    public function __invoke(
        CreateTaskRequest $request,
        CreateTaskUseCase $useCase
    ): JsonResponse
    {
        $useCase->execute(
            $request->get('id'),
            $request->get('name'),
            $request->get('started_at'),
            $request->get('ended_at'),
        );
        
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}

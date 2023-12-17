<?php

declare(strict_types=1);

namespace Src\Tracking\Application\UseCase;

use Src\Tracking\Domain\Repository\TaskRepository;

class GetTasksUseCase
{
    public function __construct(
        private readonly TaskRepository $repository
    ) {
    }

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
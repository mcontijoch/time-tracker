<?php

declare(strict_types=1);

namespace Src\Tracking\Domain\Repository;

use Src\Tracking\Domain\Entity\Task\Task;
use Src\Tracking\Domain\Entity\Task\TaskName;

interface TaskRepository
{
    public function save(Task $task): void;
    public function getAll(): array;

    public function find(TaskName $name): ?Task;
}
<?php

declare(strict_types=1);

namespace Src\Tracking\Infrastructure\Repository;

use Src\Tracking\Domain\Entity\Task\Task;
use Src\Tracking\Domain\Entity\Task\TaskName;
use Src\Tracking\Domain\Repository\TaskRepository;
use Src\Tracking\Infrastructure\Model\EloquentTask;
use Src\Tracking\Infrastructure\Model\EloquentTracking;

class EloquentTaskRepository implements TaskRepository
{
    public function save(Task $task): void
    {
        $eloquentTask = EloquentTask::fromDomain($task);
        $eloquentTask->save();

        $eloquentTask->trackings()->each(fn(EloquentTracking $tracking) => $tracking->save());
    }

    public function getAll(): array
    {
        $tasks = EloquentTask::with('trackings')->get()->toArray();
        
        return array_map(fn(EloquentTask $task) => $task->toDomain(), $tasks);
    }

    public function find(TaskName $name): ?Task
    {
        $task = EloquentTask::query()
            ->with('trackings')
            ->where('name', $name->value)
            ->first();

        return $task?->toDomain();
    }
}
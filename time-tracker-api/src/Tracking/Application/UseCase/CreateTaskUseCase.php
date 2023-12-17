<?php

declare(strict_types=1);

namespace Src\Tracking\Application\UseCase;

use Src\Tracking\Domain\Entity\Task\Task;
use Src\Tracking\Domain\Entity\Task\TaskCreatedAt;
use Src\Tracking\Domain\Entity\Task\TaskId;
use Src\Tracking\Domain\Entity\Task\TaskName;
use Src\Tracking\Domain\Entity\Tracking\Tracking;
use Src\Tracking\Domain\Entity\Tracking\TrackingEndedAt;
use Src\Tracking\Domain\Entity\Tracking\TrackingStartedAt;
use Src\Tracking\Domain\Repository\TaskRepository;
use Carbon\CarbonImmutable;

class CreateTaskUseCase
{
    public function __construct(private readonly TaskRepository $repository)
    {
    }

    public function execute(
        string $id,
        string $name,
        CarbonImmutable $startedAt,
        CarbonImmutable $endedAt
    ): void
    {
        $trackings = [];

        $existingTask = $this->repository->find(new TaskName($name));

        $task = $existingTask !== null
            ? $this->addTrackingToExistingTask($existingTask, $id, $startedAt, $endedAt)
            : $this->createNewTask($id, $startedAt, $endedAt, $trackings, $name);

        $this->repository->save($task);
    }

    /**
     * @param Tracking[] $trackings
     */
    public function createNewTask(string $id, CarbonImmutable $startedAt, CarbonImmutable $endedAt, array $trackings, string $name): Task
    {
        $tracking = Tracking::create(
            new TaskId($id),
            new TrackingStartedAt($startedAt),
            new TrackingEndedAt($endedAt)
        );

        return Task::create(
            new TaskId($id),
            new TaskName($name),
            new TaskCreatedAt(CarbonImmutable::now()),
            [$tracking]
        );
    }

    public function addTrackingToExistingTask(Task $existingTask, string $id, CarbonImmutable $startedAt, CarbonImmutable $endedAt): Task
    {
        return $existingTask->addTracking(Tracking::create(
            new TaskId($id),
            new TrackingStartedAt($startedAt),
            new TrackingEndedAt($endedAt)
        ));
    }
}
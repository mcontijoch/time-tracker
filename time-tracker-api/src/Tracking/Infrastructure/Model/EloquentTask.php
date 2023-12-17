<?php

namespace Src\Tracking\Infrastructure\Model;

use Src\Tracking\Domain\Entity\Task\Task;
use Src\Tracking\Domain\Entity\Task\TaskCreatedAt;
use Src\Tracking\Domain\Entity\Task\TaskId;
use Src\Tracking\Domain\Entity\Task\TaskName;
use Src\Tracking\Domain\Entity\Tracking\Tracking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EloquentTask extends Model
{
    use HasFactory;
    
    protected $table = 'tasks';
    
    public function trackings(): HasMany
    {
        return $this->hasMany(EloquentTracking::class, 'id', 'task_id');
    }

    public function toDomain(): Task
    {
        $trackings = $this->trackings()->get()->toArray();

        return Task::create(
            new TaskId($this->getAttributeValue('id')),
            new TaskName($this->getAttributeValue('name')),
            new TaskCreatedAt($this->getAttributeValue('created_at')),
            array_map(fn(EloquentTracking $tracking) => $tracking->toDomain(), $trackings)
        );
    }

    public static function fromDomain(Task $task): self
    {
        $eloquentTrackings = array_map(fn(Tracking $tracking) => EloquentTracking::fromDomain($tracking), $task->trackings);

        return (new self())
            ->setAttribute('id', $task->id->value)
            ->setAttribute('name', $task->name->value)
            ->setAttribute('created_at', $task->startedAt->value)
            ->setRelationValue('trackings', new Collection([$eloquentTrackings]))
        ;
    }
}

<?php

namespace Apps\Web\Controller;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'name' => ['required', 'string'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['required', 'date'],
        ];
    }
}

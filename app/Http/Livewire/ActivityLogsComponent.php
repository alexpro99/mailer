<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsComponent extends Component
{
    use WithPagination;

    public $filter, $inputs = 10;
    protected $paginationTheme = 'tailwind';
    public function mount()
    {

    }
    public function render()
    {
        $activity_log = $this->queryLogs()->paginate($this->inputs);
        $activities = $activity_log->map(function ($item) {
            return Activity::where('activity_log.id', $item->id)->first();
        });
        return view('livewire.activity-logs-component', compact('activities', 'activity_log'));
    }

    private function queryLogs() {
        $activity = Activity::select('activity_log.id')
        ->join('users', 'users.id', 'causer_id')
        ->where('log_name', 'like', '%'.$this->filter.'%')
        ->orWhere('description', 'like', '%'.$this->filter.'%')
        ->orWhere('users.name', 'like', '%'.$this->filter.'%')
        ->orWhere('users.email', 'like', '%'.$this->filter.'%');
        return $activity;
    }
}

<?php

namespace App\Livewire\Administrative\ActivityLogs;

use App\Models\ActivityLog as ModelsActivityLog;
use Livewire\Component;
use Models\ActivityLog;
use Livewire\WithPagination;
class ActivityLogs extends Component
{

    use WithPagination;
    public $search = '';
    public function render()
    {
        $logs = ModelsActivityLog::with('user')->orderBy('id', 'asc')
         ->whereRelation('user', 'name', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.administrative.activity-logs.activity-logs', compact('logs'));
    }
}

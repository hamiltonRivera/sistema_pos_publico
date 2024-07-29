<?php

namespace App\Livewire\Administrative\UsersControl;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ActivityLog;
class UsersControl extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedRole = [];

    public function mount()
    {
      // Inicializar $selectedRole con un array vacío para cada usuario
      $this->selectedRole = array_fill_keys(User::pluck('id')->toArray(), '');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')->paginate(8);
        return view('livewire.administrative.users-control.users-control', [
            'users' => $users,
            'roles' => Role::all()
        ]);
    }

    public function refresh()
    {
        return redirect('/private/admin/userscontrol');
    }

    public function assignRoles()
    {
        foreach ($this->selectedRole as $userId => $roleName) {
            $user = User::find($userId);

            if ($user && $roleName) {
                $user->syncRoles([$roleName]);
            }
        }

        //registro de actividad
        $newActivitie = new ActivityLog();
            $newActivitie->user_id = auth()->user()->id;
            $newActivitie->activity = "Cambio de rol";
            $newActivitie->detail = $user->name;
            $newActivitie->save();


       Alert::success('Usuarios', 'Usuario actualizado');
       $this->refresh();
    }



}

<?php

namespace App\Http\Livewire\Dashboard\Admin\ScopeManagement\Modals;

use App\Models\User;
use App\Traits\ToastTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class CreateUserAccount extends Component
{
    use ToastTrait;

    public $name, $email, $password, $password_confirmation, $update_id = null;

    protected $listeners = ['editAdminAccount', 'deleteAdminAccount'];

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->update_id],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function updated($property)
    {
        return $this->validateOnly($property);
    }

    public function store()
    {
        $data = $this->validate();
        $data['role'] = 'admin';
        $data['password'] = Hash::make($data['password']);

        try {
            DB::transaction(function () use ($data) {
                $model = User::updateOrCreate(['id' => $this->update_id], $data);

                $model->addMedia(public_path('assets/img/avatar.png'))->preservingOriginal()->toMediaCollection('avatars', 'avatars');

                $new['user_id'] = $model->id;

                auth()->user()->assigner()->updateOrCreate($new);

                $this->getSuccess("Admin account was created successfully. 😉");
                $this->reset();
            });
        } catch (Exception $exception) {
            $this->getException($exception);
        }
    }

    public function editAdminAccount($id)
    {
        $model = User::find($id);
        $this->name = $model->name;
        $this->email = $model->email;
        $this->update_id = $model->id;
    }

    public function deleteAdminAccount(User $user)
    {
        $user->delete();
        $this->getSuccess("Admin account was delete successfully. 😉");
    }

    public function render()
    {
        return view('livewire.dashboard.admin.scope-management.modals.create-user-account');
    }
}

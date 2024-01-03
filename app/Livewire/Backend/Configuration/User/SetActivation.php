<?php

namespace App\Livewire\Backend\Configuration\User;

use Exception;
use Throwable;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SetActivation extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_activation_user_data' => 'set_user_data'];

    public User $user;

    public $is_show = false;

    public function render()
    {
        return view('livewire.backend.configuration.user.set-activation');
    }

    public function set_user_data(User $user)
    {
        if ($user->role_name != 'Administrator') {
            $this->is_show = true;
            $this->user = $user;
        } else {
            $this->set_init();
        }
    }

    public function set_init()
    {
        $this->is_show = false;
        $this->reset('user');
    }

    public function update_user($status)
    {
        try {
            $this->user->update([
                'status' => $status
            ]);

            $this->dispatch('refresh_users');
            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('User')]));
            $this->set_init();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}

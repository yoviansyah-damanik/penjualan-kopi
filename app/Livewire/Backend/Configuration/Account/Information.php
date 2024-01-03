<?php

namespace App\Livewire\Backend\Configuration\Account;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Information extends Component
{
    use LivewireAlert;
    public $user_id;
    public $username;
    public $name;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.backend.configuration.account.information');
    }

    public function rules()
    {
        return [
            'username' => 'required|min:8|max:200|alpha_dash|string|unique:users,username,' . $this->user_id,
            'name' => 'required|min:8|max:200|string',
            'email' => 'required|string|email:dns|unique:users,email,' . $this->user_id,
        ];
    }

    public function validationAttributes()
    {
        return [
            'username' => __('Username'),
            'name' => __('Full Name'),
            'email' => __('Email'),
        ];
    }

    public function update_user()
    {
        $this->validate();
        try {
            $user = User::find($this->user_id);
            $user->username = $this->username;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();

            $this->alert(
                'success',
                __('The :feature was successfully updated.', ['feature' => __('Account Information')]),
            );
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}

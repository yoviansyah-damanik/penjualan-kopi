<?php

namespace App\Livewire\Backend\Configuration\User;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    #[Rule('required|min:8|max:32|alpha_dash|string|unique:users,username')]
    public $username;
    #[Rule('required|string|min:3|max:200')]
    public $name;
    #[Rule('required|string|email:dns|unique:users,email')]
    public $email;

    public $password;
    #[Rule('required|string|same:password')]
    public $re_password;
    public function render()
    {
        return view('livewire.backend.configuration.user.create');
    }

    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                Password::min(8)->letters()->numbers()
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'username' => __('Username'),
            'name' => __('Full Name'),
            'email' => __('Email'),
            'password' => __('Password'),
            're_password' => __('Re-Password'),
        ];
    }
    public function store_user()
    {
        $this->validate();
        try {
            $new_user = new User();
            $new_user->username = $this->username;
            $new_user->name = $this->name;
            $new_user->email = $this->email;
            $new_user->password = bcrypt($this->password);
            $new_user->save();

            $new_user->assignRole('Administrator');
            $this->alert(
                'success',
                __('The :feature was successfully registered.', ['feature' => __('Account')])
            );
            $this->dispatch('refresh_users');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}

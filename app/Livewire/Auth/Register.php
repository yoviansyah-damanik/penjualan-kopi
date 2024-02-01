<?php

namespace App\Livewire\Auth;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use LivewireAlert;
    #[Rule('required|min:8|max:32|alpha_dash|string|unique:users,username')]
    public $username;

    #[Rule('required|min:8|max:200|string')]
    public $name;

    #[Rule('required|string|email:dns|unique:users,email')]
    public $email;

    public $password;

    #[Rule('required|string|same:password')]
    public $re_password;

    #[Rule('required|accepted')]
    public $terms_and_conditions;

    public $submit_button = true;
    public function render()
    {
        return view('livewire.auth.register')
            ->title(__('Sign Up'));
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
            'terms_and_conditions' => __('Terms and Conditions')
        ];
    }

    public function register()
    {
        $this->validate();
        try {
            $new_user = new User();
            $new_user->username = $this->username;
            $new_user->name = $this->name;
            $new_user->email = $this->email;
            $new_user->password = bcrypt($this->password);
            $new_user->save();

            $new_user->assignRole('User');
            $this->alert(
                'success',
                __('The :feature was successfully registered.', ['feature' => __('Account')]),
                ['text' => __('You will be directed to the login page. Please wait.')]
            );
            $this->dispatch('successRegisterHandler');
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function disable_submit_button()
    {
        $this->submit_button = false;
    }

    public function redirect_to_login()
    {
        return $this->redirect(route('login'), navigate: false);
    }
}

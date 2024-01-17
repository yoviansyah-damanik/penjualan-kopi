<?php

namespace App\Livewire\Auth;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use App\Enums\UserStatusType;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    use LivewireAlert;

    #[Rule('required|string')]
    public $username;

    #[Rule('required|string')]
    public $password;

    #[Rule('nullable|boolean')]
    public $remember_me;

    public $button_enabled = true;
    public function render()
    {
        return view('livewire.auth.login')
            ->title(__('Sign In'));
    }

    public function validationAttributes()
    {
        return [
            'username' => __('Username'),
            'password' => __('Password'),
            'remember_me' => __('Remember Me')
        ];
    }
    public function login()
    {
        $this->validate();
        try {
            $this->button_enabled = false;
            $username = $this->username;
            $password = $this->password;

            $fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $user = User::where($fieldType, $username)
                ->first();

            if ($user) {
                if ($user->status == UserStatusType::Blocked) {
                    $this->button_enabled = true;
                    return $this->alert('error', __('Your account has been blocked. Please contact the administrator for further information.'));
                }

                if (Hash::check($password, $user->password)) {
                    if ($user->status == UserStatusType::Blocked)
                        return $this->alert('error', __('Your account has been blocked. Please contact the administrator for further information.'));

                    Auth::login($user, $this->remember_me === true);

                    session()->regenerate();

                    return $this->redirect(session()->pull('url.intended', '/'));

                    // if (Auth::user()->role_name == 'User')
                    // return $this->redirect(route('home'), false);

                    // return to_route('dashboard.home');
                }

                $this->button_enabled = true;
                return $this->alert('warning', __('Wrong Authentication.'));
            }

            $this->button_enabled = true;
            return $this->alert('warning', __('No user found.'));
        } catch (Exception $e) {
            $this->button_enabled = true;
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->button_enabled = true;
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}

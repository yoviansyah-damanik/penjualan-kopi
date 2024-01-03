<?php

namespace App\Livewire\Backend\Configuration\Account;

use Exception;
use Throwable;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Password extends Component
{
    use LivewireAlert;
    public $password;
    public $new_password;
    public $re_password;

    public function render()
    {
        return view('livewire.backend.configuration.account.password');
    }

    public function rules()
    {
        return [
            'password' => 'required|current_password',
            'new_password' => [
                'required',
                'string',
                PasswordRule::min(8)->letters()->numbers()
            ],
            're_password' => 'required|same:new_password'
        ];
    }

    public function validationAttributes()
    {
        return [
            'password' => __('Current Password'),
            'new_password' => __('New Password'),
            're_password' => __('Re-Password')
        ];
    }

    public function update_user()
    {
        $this->validate();
        try {
            $user = Auth::user();
            $user->password = bcrypt($this->password);
            $user->save();

            $this->alert(
                'success',
                __('The :feature was successfully updated.', ['feature' => __('Password')]),
            );
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}

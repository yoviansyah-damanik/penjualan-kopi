<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;

class Team extends Component
{
    public function render()
    {
        $teams = json_decode((file_get_contents(public_path('team.json'))));

        return view('livewire.frontend.home.team', compact('teams'));
    }
}

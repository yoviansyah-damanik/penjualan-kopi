<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;

class Testimonial extends Component
{
    public function render()
    {
        $testimonials = json_decode((file_get_contents(public_path('testimonial.json'))));

        return view('livewire.frontend.home.testimonial', compact('testimonials'));
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public $categories;
    public function __construct($categories = [])
    {
        $this -> categories = $categories;
    }
    public function render(): View
    {
        return view('layouts.guest');
    }
}

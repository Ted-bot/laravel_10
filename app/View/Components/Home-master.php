<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class HomeMaster extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $user_logged_in
    )
    {
        $user_logged_in = Auth::check();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-master');
    }
}

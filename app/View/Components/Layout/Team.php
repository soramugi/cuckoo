<?php

namespace App\View\Components\Layout;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Team extends Component
{
    public User $user;

    /**
     * Create a new component instance.
     */
    public function __construct(
    ) {
        $this->user = Auth::user();

        if (! $this->user->currentTeam) {
            foreach ($this->user->allTeams() as $team) {
                if ($this->user->switchTeam($team)) {
                    break;
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.team');
    }
}

<li>

    <div class="text-xs font-semibold leading-6 text-gray-400">
        {{ __('Manage Team') }}
    </div>

    <ul role="list" class="-mx-2 space-y-1">
        <li>
            <a href="{{ route('teams.show', $user->currentTeam->id) }}"
                class="{{ request()->routeIs('teams.show') ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                {{ __('Team Settings') }}
            </a>
        </li>

        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
        <li>
            <a href="{{ route('teams.create') }}"
                class="{{ request()->routeIs('teams.create') ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                {{ __('Create New Team') }}
            </a>
        </li>
        @endcan

    </ul>

    @if ($user->allTeams()->count() > 1)
    <div class="border-t border-gray-200 my-2"></div>

    <div class="text-xs font-semibold leading-6 text-gray-400">
        {{ __('Switch Teams') }}
    </div>
    <ul role="list" class="-mx-2 mt-2 space-y-1">

        @foreach ($user->allTeams() as $team)
        <li>
            <form method="POST" action="{{ route('current-team.update') }}" class="" x-data>
                @method('PUT')
                @csrf
                <input type="hidden" name="team_id" value="{{ $team->id }}">

                <button type="submit"
                    class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-md flex w-full group gap-x-3 p-2 text-sm leading-6 font-semibold">
                    @if ($user->isCurrentTeam($team))
                    <svg class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    @endif
                    <span class="truncate">{{ $team->name }}</span>
                </button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif

</li>
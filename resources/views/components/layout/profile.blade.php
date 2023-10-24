<!-- Profile dropdown -->
<div class="relative" x-data="{ openProfileDropdown: false }">
    <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
        @click="openProfileDropdown = !openProfileDropdown" aria-expanded="false" aria-haspopup="true">
        <span class="sr-only">Open user menu</span>
        <img class="h-8 w-8 rounded-full bg-gray-50"
            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="">
        <span class="hidden lg:flex lg:items-center">
            <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">Tom
                Cook</span>
            <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </button>

    <div x-show="openProfileDropdown" @click.outside="openProfileDropdown = false"
        class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <!-- Active: "bg-gray-50", Not Active: "" -->
        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1"
            id="user-menu-item-0">Your profile</a>
        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1"
            id="user-menu-item-1">Sign out</a>
    </div>
</div>
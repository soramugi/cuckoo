<div x-data="{ dropdownOpen: false }" class="inline-flex rounded-md shadow-sm">
    <span
        class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300">
        一覧操作
    </span>
    <div class="relative -ml-px block">
        <button type="button" @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false"
            class="relative inline-flex items-center rounded-r-md bg-white px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"
            id="option-menu-button" aria-expanded="true" aria-haspopup="true">
            <span class="sr-only">Open options</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="dropdownOpen"
            class="absolute right-0 z-10 -mr-1 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a href="{{ route('reminders.export') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-50" role="menuitem"
                    tabindex="-1" id="option-menu-item-0">
                    登録データのエクスポート
                </a>
                <form method="POST" action="{{ route('reminders.import') }}" class="block text-gray-700 px-4 py-2 text-sm hover:bg-gray-50" x-data>
                    @csrf

                    {{-- TODO: ファイル選択でアップロード --}}
                    <button type="submit" role="menuitem" class="w-full" tabindex="-1"
                        id="option-menu-item-1">
                        インポート
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
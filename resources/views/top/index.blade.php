<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h1>
    </x-slot>

    <div>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">CuckooRemind バージョン</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ cuckooremind_version() }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Laravel バージョン</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ App::VERSION() }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">PHP バージョン</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ phpversion() }}</dd>
            </div>
        </dl>

        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">表示中のチーム</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ Auth::user()->currentTeam?->name }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">チーム内登録通知数</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $reminderCount }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">最終通知済み時間</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $reminderLastTime }}</dd>
            </div>
        </dl>
    </div>

</x-app-layout>
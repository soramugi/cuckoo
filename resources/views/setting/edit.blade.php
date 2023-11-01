<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Settings
        </h1>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-form-section submit="createApiToken">
                <x-slot name="title">
                    Cron URL
                </x-slot>

                <x-slot name="description">
                    通知設定を実行するために cron の設定をする必要があります。
                    cronの実行をするためにはあらかじめ<a href="{{ route('api-tokens.index') }}" class="underline">API Token</a>を作成して差し替えてください。
                </x-slot>

                <x-slot name="form">

                    <div class="col-span-6">
                        <x-label for="url" value="URL" />
                        <x-input id="url" type="text" class="mt-1 block w-full" value="{{ route('cron') . '?token=<作成したAPI Token>' }}"/>
                    </div>

                </x-slot>
            </x-form-section>

        </div>
    </div>
</x-app-layout>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('setup.store') }}">
            @csrf

            <div class="pb-6">
                <p>サーバー初回セットアップを実行してください</p>
                <p>データ保存やメール送信などのアプリケーションの実行に関する環境変数を自動設定します。</p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    実行
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
<x-app-layout>

    <x-slot name="header">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Reminder 詳細</h1>
                <p class="mt-2 text-sm text-gray-700">
                    登録済みの通知詳細
                </p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            </div>
        </div>
    </x-slot>

    <div class="flow-root">

        <div class="space-y-12 sm:space-y-16">

            <dl
                class="space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:pb-0">

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <dt class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Title</dt>
                    <dd class="mt-2 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $reminder->title }}
                    </dd>

                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <dt class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Description</dt>
                    <dd class="mt-2 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $reminder->description }}
                    </dd>

                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <dt class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">繰り返しタイプ</dt>
                    <dd class="mt-2 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $reminder->repeat_text }}
                    </dd>

                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <dt class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">通知時間</dt>
                    <dd class="mt-2 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $reminder->time }}
                    </dd>

                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <dt class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                        通知の送信先メールアドレス
                    </dt>
                    <dd class="mt-2 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $reminder->to }}
                    </dd>

                </div>

            </dl>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">

            <a href="{{ route('reminders.edit', [$reminder]) }}"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>

            <form action="{{ route('reminders.destroy', [$reminder]) }}" method="POST">
                @csrf
                @method('delete')

                <button type="submit" onclick="return confirm('削除してもよろしいですか?')"
                    class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
            </form>

        </div>

    </div>
</x-app-layout>
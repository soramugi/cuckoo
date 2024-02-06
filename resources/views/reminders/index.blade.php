<x-app-layout>

    <x-slot name="header">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Reminders</h1>
                <p class="mt-2 text-sm text-gray-700">
                    設定済みの通知一覧
                </p>
            </div>
            <div class="flex gap-x-4 justify-end mt-4 sm:ml-16 sm:mt-0">
                <a href="{{ route('reminders.create') }}"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    追加
                </a>

                @include('reminders._list_operation')

            </div>
        </div>
    </x-slot>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                通知時間
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Title
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Next
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Show</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($reminders as $reminder)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                {{ $reminder->repeat_text }} {{ $reminder->time }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                {{ $reminder->title }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $reminder->next_send->format('Y-m-d H:i') }}
                            </td>
                            <td
                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <a href="{{ route('reminders.show', [$reminder]) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    Show
                                    <span class="sr-only">{{ $reminder->title }}</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $reminders->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

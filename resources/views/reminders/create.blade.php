<x-layout>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Reminder 作成</h1>
            <p class="mt-2 text-sm text-gray-700">
                通知内容の新規作成
            </p>
        </div>

        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">

            @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">送信内容に {{ count($errors) }} つのエラーがありました</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <form action="{{ route('reminders.store') }}" method="POST" class="flow-root">
        @csrf

        <div class="space-y-12 sm:space-y-16">

            <div
                class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Title</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input type="text" name="title" id="title" autocomplete="title" value="{{ old('title') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="description"
                        class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Description</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <textarea id="description" name="description" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                        <p class="mt-3 text-sm leading-6 text-gray-600">
                            通知内容の詳細を記載
                        </p>
                    </div>
                </div>

                <fieldset x-data="{ type: '{{ old('type', 'month') }}' }">
                    <legend class="sr-only">繰り返しタイプ</legend>
                    <div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4 sm:py-6">
                        <div class="text-sm font-medium leading-6 text-gray-900" aria-hidden="true">
                            繰り返しタイプ
                        </div>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <div class="max-w-lg">
                                <p class="text-sm leading-6 text-gray-600">

                                </p>
                                <div class="space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input x-model="type" id="type-month" name="type" type="radio" value="month"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="type-month"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            毎月
                                        </label>

                                        <div x-show="type === 'month'" class="flex items-center gap-x-3">
                                            <select id="day" name="day" autocomplete="day"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                                @foreach (range(1, 31) as $day)
                                                <option value="{{ $day }}" @if(old('day')==$day) selected @endif>
                                                    {{ $day }}
                                                </option>
                                                @endforeach
                                            </select>
                                            日
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input x-model="type" id="type-week" name="type" type="radio" value="week"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="type-week"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            毎週
                                        </label>

                                        <div x-show="type === 'week'"
                                            class="flex items-center gap-x-3 whitespace-nowrap">
                                            <select id="week" name="week" autocomplete="week"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                                @foreach (['日', '月', '火', '水', '木', '金', '土'] as $i => $week)
                                                <option value="{{ $i }}" @if(old('week')==$i) selected @endif>
                                                    {{ $week }}
                                                </option>
                                                @endforeach
                                            </select>
                                            曜日
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="time" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                        通知時間
                    </label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input type="time" name="time" id="time" autocomplete="time" value="{{ old('time') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="to" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                        通知の送信先メールアドレス
                    </label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <input id="to" name="to" type="email" autocomplete="to" value="{{ old('to') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-md sm:text-sm sm:leading-6">
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">

            <input type="reset"
                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                value="Cancel">

            <button type="submit"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

</x-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($data['user']->vaccination_status)
                        {{ __('Vaccination status: '.$data['user']->vaccination_status) }}
                    @endif
                    @if($errors->any())
                        <div class="text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @if(@empty($data['user']->schedule->date))
                    <div class="flex justify-end mb-4">
                        <form action="{{ route('schedule.vaccination') }}" method="POST">
                            @csrf
                            <input type="hidden" name="daily_limit"
                                   value="{{$data['user']->vaccine_center?->daily_limit}}">
                            <input type="hidden" name="schedule_date"
                                   value="{{$data['user']->schedule?->date}}">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded">
                                Get Schedule
                            </button>
                        </form>
                    </div>
                @endif

                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                            Nid
                        </th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                            Name
                        </th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                            Email
                        </th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                            Vaccine Center
                        </th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                            Vaccination date
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data['user'])
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->nid }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->email }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->vaccine_center?->name?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->schedule?->date?? 'N/A' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">N/A</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

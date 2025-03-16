<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 sm:px-6">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <ul class="divide-y divide-gray-200 ">
                    @foreach ($contacts as $contact)
                    <li class="pb-3 sm:pb-4">
                        <div class="flex items-center justify-between space-x-4 px-5 py-2">
                            <div class="shrink-0">
                                <p class="text-sm font-medium text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-500">{{ $contact->email }}</p>
                            </div>
                            <div class="inline-flex items-center text-base bold-semibold text-gray-900">
                                <a href="{{ route('chat.show', $contact->id)}}" class="bg-green-200 hover:bg-green-300 rounded px-3 text-green-600">{{('Send Message')}}</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
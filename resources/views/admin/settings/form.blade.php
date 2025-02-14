<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between gap-2 items-center">
            <a
                href="{{ url('/dashboard') }}"
                class="cursor-pointer text-gray-600 hover:text-gray-900"
            >
                &larr; Back to Dashboard
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Settings Form") }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('message'))
            <div id="session_message" class="text-center mb-6 md:text-xl text-green-600">
                {{ session('message') }}
                <script>
                    setTimeout(()=> {
                        document.getElementById('session_message').remove();
                    }, 3000)
                </script>
            </div>
            @endif

            <form
                method="POST"
                action="{{ url('/dashboard/settings') }}"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 md:p-8 grid gap-4"
                enctype="multipart/form-data"
            >
                @csrf @method('PUT')

                <div class="grid gap-4 lg:grid-cols-12">
                    <div class="lg:col-span-6">
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Phone
                        </label>
                        <input
                            value="{{ old('phone') ?? ($settings['phone'] ?? '') }}"
                            type="text"
                            id="phone"
                            name="settings[phone]"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        />
                        @error('phone')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="lg:col-span-6">
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Email
                        </label>
                        <input
                            value="{{ old('email') ?? ($settings['email'] ?? '') }}"
                            type="email"
                            id="email"
                            name="settings[email]"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        />
                        @error('email')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label
                            for="settings[facebook]"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Facebook
                        </label>
                        <input
                            value="{{ old('facebook') ?? ($settings['facebook'] ?? '') }}"
                            type="url"
                            id="facebook"
                            name="settings[facebook]"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        />
                        @error('facebook')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label
                            for="address"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Address
                        </label>
                        <textarea
                            type="text"
                            id="address"
                            name="settings[address]"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md min-h-28"
                        >{{ old('address') ?? ($settings['address'] ?? '') }}</textarea>
                        @error('address')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr />

                <div class="flex justify-between gap-2 items-center">
                    <a
                        href="{{ url('/dashboard') }}"
                        class="cursor-pointer text-gray-600 hover:text-gray-900"
                    >
                        &larr; Back without save
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-1 border rounded-md cursor-pointer border-green-600 text-green-600 bg-white hover:text-white hover:bg-green-600"
                    >
                        Submit & Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

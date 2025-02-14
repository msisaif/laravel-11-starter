<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between gap-2 items-center">
            <a
                href="{{ route('dashboard.users.index') }}"
                class="cursor-pointer text-gray-600 hover:text-gray-900"
            >
               &larr; Back to List
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New User Form') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form
                method="POST"
                action="{{ route('dashboard.users.store') }}"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 md:p-8 grid gap-4"
                enctype="multipart/form-data"
                autocomplete="off"
            >
                @csrf
                
                @include('admin.users.form')
                
                <hr />

                <div class="flex justify-between gap-2 items-center">
                    <a
                        href="{{ route('dashboard.users.index') }}"
                        class="cursor-pointer text-gray-600 hover:text-gray-900"
                    >
                        &larr; Back without save
                    </a>
                    <button 
                        type="submit"
                        class="px-4 py-1 border rounded-md cursor-pointer border-green-600 text-green-600 bg-white hover:text-white hover:bg-green-600"
                    >
                        Save changed data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

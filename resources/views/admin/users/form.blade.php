<div class="grid gap-4 lg:grid-cols-12">
    <!-- Name -->
    <div class="col-span-full">
        <label for="name" class="block text-sm font-medium text-gray-700">User Name</label>
        <input value="{{ old('name') ?? $user->name }}" type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('name')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-span-full">
        <label for="email" class="block text-sm font-medium text-gray-700">User Email</label>
        <input value="{{ old('email') ?? $user->email }}" type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('email')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    @if($user->password)
    <hr class="col-span-full" />
    <div class="col-span-full font-bold text-center text-rose-500">
        If you want to change the password, fill in the password field
    </div>
    @endif

    <!-- Password -->
    <div class="lg:col-span-6">
        <label for="password" class="block text-sm font-medium text-gray-700">User Password</label>
        <input autocomplete="new-password" value="" type="password" id="password" name="password" class="mt-1 p-2 w-full border border-gray-300 rounded-md" {{ $user->password ? '' : 'required' }}>
        @error('password')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Confirmation -->
    <div class="lg:col-span-6">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input autocomplete="new-password" value="" type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 w-full border border-gray-300 rounded-md" {{ $user->password ? '' : 'required' }}>
        @error('password_confirmation')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
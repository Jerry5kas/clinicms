<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Dropdown -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" required
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient</option>
                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>



        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" name="password"
                       class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       required autocomplete="new-password" />

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': show, 'block': !show }"
                         class="h-5 w-5 text-gray-500 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg @click="show = !show" :class="{'block': show, 'hidden': !show }"
                         class="h-5 w-5 text-gray-500 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.955 9.955 0 012.221-3.592m2.182-1.7A9.956 9.956 0 0112 5c4.477 0 8.267 2.943 9.541 7a9.965 9.965 0 01-4.155 5.225M15 12a3 3 0 00-3-3m0 0a3 3 0 00-2.829 2M9.879 9.879l4.242 4.242M3 3l18 18" />
                    </svg>
                </div>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Confirm Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                       class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       required autocomplete="new-password" />

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': show, 'block': !show }"
                         class="h-5 w-5 text-gray-500 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg @click="show = !show" :class="{'block': show, 'hidden': !show }"
                         class="h-5 w-5 text-gray-500 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.955 9.955 0 012.221-3.592m2.182-1.7A9.956 9.956 0 0112 5c4.477 0 8.267 2.943 9.541 7a9.965 9.965 0 01-4.155 5.225M15 12a3 3 0 00-3-3m0 0a3 3 0 00-2.829 2M9.879 9.879l4.242 4.242M3 3l18 18" />
                    </svg>
                </div>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

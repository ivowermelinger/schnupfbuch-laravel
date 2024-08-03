@section('title', 'Registieren')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="mx-auto h-16 w-auto text-indigo-600" />
        </a>

        <h2
            class="mt-6 text-center text-3xl font-extrabold leading-9 text-gray-900"
        >
            Create a new account
        </h2>

        <p class="max-w mt-2 text-center text-sm leading-5 text-gray-600">
            Or
            <a
                href="{{ route('login') }}"
                class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:underline focus:outline-none"
            >
                sign in to your account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
            <form novalidate wire:submit.prevent="register">
                <x-form.input
                    label="Nickname"
                    id="nickname"
                    type="text"
                    required
                    autofocus
                />

                <div class="mt-6">
                    <label
                        for="email"
                        class="block text-sm font-medium leading-5 text-gray-700"
                    >
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="email"
                            id="email"
                            type="email"
                            required
                            class="focus:ring-blue @error('email') focus:ring-red @enderror block w-full appearance-none rounded-md border border-gray-300 border-red-300 px-3 py-2 text-red-900 placeholder-gray-400 placeholder-red-300 transition duration-150 ease-in-out focus:border-blue-300 focus:border-red-300 focus:outline-none sm:text-sm sm:leading-5"
                        />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label
                        for="password"
                        class="block text-sm font-medium leading-5 text-gray-700"
                    >
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="password"
                            id="password"
                            type="password"
                            required
                            class="focus:ring-blue @error('password') focus:ring-red @enderror block w-full appearance-none rounded-md border border-gray-300 border-red-300 px-3 py-2 text-red-900 placeholder-gray-400 placeholder-red-300 transition duration-150 ease-in-out focus:border-blue-300 focus:border-red-300 focus:outline-none sm:text-sm sm:leading-5"
                        />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium leading-5 text-gray-700"
                    >
                        Confirm Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input
                            wire:model.lazy="passwordConfirmation"
                            id="password_confirmation"
                            type="password"
                            required
                            class="focus:ring-blue block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none sm:text-sm sm:leading-5"
                        />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button
                            type="submit"
                            class="focus:ring-indigo flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out hover:bg-indigo-500 focus:border-indigo-700 focus:outline-none active:bg-indigo-700"
                        >
                            Register
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

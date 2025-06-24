<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body>
    <x-header></x-header> {{-- x-header should be outside x-layout if x-layout is for main content --}}
    <x-layout> {{-- x-layout typically wraps the main content area --}}
        <section class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center py-8"> {{-- Added min-h-screen to center content vertically --}}
            <div class="flex flex-col items-center px-4 md:px-6 py-8 mx-auto w-full max-w-md"> {{-- Adjusted padding and max-width --}}
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="logo">
                    PUSKESMAS SUKABUMI
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center"> {{-- Centered heading --}}
                            Masuk ke Akun Anda
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="{{ route('login.post') }}" method="POST"> {{-- Added method and example route --}}
                            @csrf {{-- Add CSRF token for Laravel forms --}}
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email Anda
                                </label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="nama@perusahaan.com" required autocomplete="email"> {{-- Added autocomplete --}}
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Kata Sandi
                                </label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required autocomplete="current-password"> {{-- Added autocomplete --}}
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 dark:text-gray-300">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>
                                <a href="{{ route('password.request') }}" {{-- Use a named route for forgot password --}}
                                    class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Lupa kata sandi?
                                </a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Masuk
                            </button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center"> {{-- Centered text --}}
                                Belum punya akun? <a href="{{ route('register.info') }}" {{-- Link to the new registration info page --}}
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Daftar
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </x-layout>
</body>
</html>
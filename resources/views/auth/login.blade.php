<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Login</title>
</head>

<body style="background: url('{{ asset('img/login.png') }}') no-repeat center center; background-size: cover;">
    <x-header></x-header>
    <div class="py-20 shadow-gray-500/50  ">
        <div class="flex h-full items-center justify-center">
            <div class="rounded-lg border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-900 flex-col flex h-full items-center justify-center sm:px-4">
                <div class="flex h-full flex-col justify-center gap-4 p-6">
                    <div class="left-0 right-0 inline-block border-gray-200 px-2 py-2.5 sm:px-4">
                        <form action="{{ route('login.action') }}" method="POST" class="flex flex-col gap-4 pb-4">
                            @csrf
    
                            {{-- Error Handling --}}
                            @if ($errors->any())
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
    
                            <h1 class="mb-4 text-2xl font-bold dark:text-white text-center">Login</h1>
    
                            {{-- Email --}}
                            <div>
                                <div class="mb-2">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300" for="email">Email:</label>
                                </div>
                                <div class="flex w-full rounded-lg pt-1">
                                    <div class="relative w-full">
                                        <input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg"
                                            id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                                    </div>
                                </div>
                            </div>
    
                            {{-- Password --}}
                            <div>
                                <div class="mb-2">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300" for="password">Password:</label>
                                </div>
                                <div class="flex w-full rounded-lg pt-1">
                                    <div class="relative w-full">
                                        <input
                                            class="block w-full border disabled:cursor-not-allowed disabled:opacity-50 bg-gray-50 border-gray-300 text-gray-900 focus:border-cyan-500 focus:ring-cyan-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500 p-2.5 text-sm rounded-lg"
                                            id="password" type="password" name="password" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm cursor-pointer text-blue-500 hover:text-blue-600">Forgot password?</p>
                            </div>
    
                            {{-- Remember Me --}}
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-cyan-600 bg-gray-100 border-gray-300 rounded focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                            </div>
    
                            {{-- Submit --}}
                            <div class="flex flex-col gap-2">
                                <button type="submit"
                                    class="border transition-colors focus:ring-2 p-0.5 disabled:cursor-not-allowed border-transparent bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white disabled:bg-gray-300 disabled:text-gray-700 rounded-lg">
                                    <span class="flex items-center justify-center gap-1 font-medium py-1 px-2.5 text-base">
                                        Login
                                    </span>
                                </button>
                            </div>
                        </form>
    
                        {{-- Register link --}}
                        <div class="min-w-[270px]">
                            <div class="mt-4 text-center dark:text-gray-200">
                                
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</body>

</html>

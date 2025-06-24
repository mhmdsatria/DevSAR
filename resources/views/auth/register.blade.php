<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Register</title>
</head>

<body class="h-full bg-white">
    <div class="flex min-h-full flex-col items-center justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm items-center justify-center gap-4">
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register.save') }}" method="POST">
                @csrf

                <div>
                    <label class="label">
                        <span class="text-base label-text">Name</span>
                    </label>
                    <input name="name" type="text" placeholder="Name"
                        class="w-full input input-bordered @error('name') is-invalid @enderror" />
                    @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="label">
                        <span class="text-base label-text">Email</span>
                    </label>
                    <input name="email" type="email" placeholder="Email Address"
                        class="w-full input input-bordered @error('email') is-invalid @enderror" />
                    @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="label">
                        <span class="text-base label-text">Password</span>
                    </label>
                    <input name="password" type="password" placeholder="Enter Password"
                        class="w-full input input-bordered @error('password') is-invalid @enderror" />
                    @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="label">
                        <span class="text-base label-text">Confirm Password</span>
                    </label>
                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                        class="w-full input input-bordered" />
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block">Register Account</button>
                </div>

                <div class="text-center text-sm text-gray-500 mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

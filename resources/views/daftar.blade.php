<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Daftar</title>
</head>

<body>
    <x-layout>
        <section class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
            <div class="flex flex-col items-center justify-center px-4 py-8 mx-auto w-full max-w-md">
                <a href="#" class="flex items-center mb-6 text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-7 h-7 sm:w-8 sm:h-8 mr-2" src="{{ asset('img/puskesmas-seeklogo-3.svg') }}" alt="logo">
                    PUSKESMAS SUKABUMI
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8 text-center">
                        <h1
                            class="text-xl sm:text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                            Pendaftaran Akun
                        </h1>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300">
                            Untuk melakukan pendaftaran akun, silakan langsung menghubungi <br>
                            <strong>Diskominfo</strong> untuk informasi lebih lanjut.
                        </p>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300">
                            Anda dapat menghubungi Diskominfo melalui:
                        </p>
                        <div class="space-y-2 text-sm sm:text-base">
                            <p class="text-gray-700 dark:text-gray-300"><strong>Email:</strong>
                                diskominfo@sukabumi.go.id</p>
                            <p class="text-gray-700 dark:text-gray-300"><strong>Telepon:</strong> (0266) 123456</p>
                            <p class="text-gray-700 dark:text-gray-300"><strong>Alamat:</strong> Jl. Raya Sukabumi No.
                                10</p>
                        </div>
                        <a href="/beranda"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </x-layout>
</body>

</html>
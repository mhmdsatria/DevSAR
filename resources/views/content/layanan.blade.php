<div class="grid gap-14 md:grid-cols-3 md:gap-5">
    @foreach($pelayanans as $pelayanan)
        <div class="rounded-xl bg-white p-6 text-center shadow-xl">
            <h1 class="text-darken mb-3 text-xl font-medium lg:px-14">{{ $pelayanan->title }}</h1>
            <p class="px-4 text-gray-500">{{ $pelayanan->description }}</p>
        </div>
    @endforeach
</div>
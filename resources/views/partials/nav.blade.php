<nav class="bg-orange-700 text-white shadow-md">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-5 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
        <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight">
            Kaon Ta! Davao – Maligad's Food Guide
        </a>

        <div class="flex flex-wrap items-center gap-5 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-orange-200">Home</a>
            <a href="{{ route('eateries.index') }}" class="hover:text-orange-200">Eateries</a>
            <a href="{{ route('districts.index') }}" class="hover:text-orange-200">Districts</a>
            <a href="{{ route('eateries.create') }}" class="rounded-lg bg-white px-4 py-2 text-orange-700 hover:bg-orange-100">
                Add Eatery
            </a>
        </div>
    </div>
</nav>

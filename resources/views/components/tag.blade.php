<div class="border-2 border-secondary text-center text-sm mt-2 uppercase w-full">
    <p class="hidden lg:block">{{ \Illuminate\Support\Str::limit($slot, '7', '...') }}</p>
    <p class="lg:hidden">{{ $slot }}</p>
</div>

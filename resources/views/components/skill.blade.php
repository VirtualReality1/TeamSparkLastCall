<div class="border-2 border-secondary bg-secondary text-primary text-sm mt-2 rounded-full text-center uppercase w-full">
    <p class="hidden lg:block">{{ \Illuminate\Support\Str::limit($slot, '7', '...') }}</p>
    <p class="lg:hidden">{{ $slot }}</p>
</div>

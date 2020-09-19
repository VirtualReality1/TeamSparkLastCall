@if(!session()->exists('cookies'))
    <div class="fixed bottom-0 right-0 left-0 md:left-auto md:w-1/3 lg:w-1/4 bg-secondary m-1 p-8 ">
        <p class="text-white">Diese Website nutzt Cookies, um Ihnen eine bestmögliche Erfahrung bieten zu können.</p>
        <a href="{{ route('privacy') }}" class="text-primary">Mehr Infos</a>
        <div class="flex pt-8 justify-center text-center">
            <a href="{{ route('cookie.accept') }}"
               class="bg-primary rounded-lg p-4 md:p-2 w-1/2 mx-2 border border-primary hover:bg-secondary hover:text-primary">Akzeptieren</a>
            <a href="{{ route('cookie.decline') }}"
               class="bg-danger rounded-lg p-4 md:p-2 w-1/2 mx-2 border border-danger hover:bg-secondary hover:text-danger">Ablehnen</a>
        </div>
    </div>
@endif

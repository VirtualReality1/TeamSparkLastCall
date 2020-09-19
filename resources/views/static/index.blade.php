@extends('layouts.app')

@section('content')
    <div class="flex flex-col has-bg-shard">
        <div class="md:h-64 h-32"></div>
        <div
            class="text-center md:text-left md:text-6xl text-5xl font-semibold tracking-wider mx-auto md:ml-32 leading-none">
            <p>Finde Dein Team.</p>
            <p>Finde Dein Projekt.</p>
        </div>
        <div class="flex justify-center">
            <p class="text-center md:text-left mt-8 text-4xl md:mr-0 md:ml-32">Deine Plattform für studentische
                Projekte.</p>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('projects.index') }}"
               class="my-12 bg-secondary text-primary py-4 px-3 rounded-lg uppercase font-semibold">Projekte
                Entdecken</a>
        </div>
        <div class="h-20 mb-8">
            <svg width="100%" height="100%" viewBox="0 0 134 220" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xml:space="preserve"
                 style="fill-rule:evenodd;clip-rule:evenodd;stroke-miterlimit:2;">
    <g transform="matrix(1,0,0,1,-103.259,-61.7561)">
        <g>
            <path
                d="M167.098,70.322L167.098,263.205C167.098,265.736 173.06,265.74 173.06,263.205L173.06,70.322C173.06,67.791 167.098,67.787 167.098,70.322Z"
                style="fill:rgb(140,164,15);fill-rule:nonzero;"/>
            <path
                d="M167.098,70.322L167.098,263.205C167.098,265.736 173.06,265.74 173.06,263.205L173.06,70.322C173.06,67.791 167.098,67.787 167.098,70.322Z"
                style="fill:none;stroke:rgb(0,40,89);stroke-width:5.96px;"/>
            <path d="M116.591,213.223L170.079,267.879L223.567,213.223"
                  style="fill:none;stroke:rgb(0,40,89);stroke-width:11.92px;"/>
        </g>
    </g>
</svg>
        </div>
        <div class="flex flex-col">
            <div class="border-secondary border-4 md:w-1/3 mx-auto p-8">
                <p class="text-4xl font-semibold">Unsere Vision.</p>
                <p class="text-2xl mt-2">Stell Dir vor, Du bist Teil eines Teams. Jeder von euch kommt aus einer anderen
                    Disziplin und ihr brennt alle für die gleiche Idee – was dabei raus kommt, kann nur gut sein.
                    Hier ist der Ort, an dem Du dein Team findest. Hier ist der Ort, an dem deine Ideen Wirklichkeit
                    werden.</p>
            </div>
            <div class="w-1/2 border-r-4 h-16 border-secondary -ml-12"></div>
        </div>
        <div class="flex flex-col bg-secondary">
            <div class="w-1/2 border-r-4 h-16 border-white -ml-12"></div>
            <div class="border-white border-4 md:w-1/3 mx-auto p-8 text-white">
                <p class="text-4xl font-semibold">Die Realität...</p>
                <p class="text-2xl mt-2">Wir hatten diese Vision; wir wurden ein Team und ein halbes Jahr später gibt es
                    diesen ersten Prototyp von team-spark.com. Er ist definitiv noch nicht fertig, aber wir sind dran.
                    Alle zwei Wochen veröffentlichen wir eine neue Version und Stück für Stück schleifen wir diesen
                    Rohdiamanten.</p>
            </div>
            <div class="w-1/2 border-r-4 h-32 border-white ml-12"></div>
            <div class="border-primary border-4 md:w-1/3 mx-auto p-8 text-primary">
                <p class="text-4xl font-semibold">Jetzt zu Dir.</p>
                <p class="text-2xl mt-2">Viele Augen sehen mehr. Du zählst zu den ersten Besuchern dieser Webseite,
                    also ist deine Meinung für uns besonders wertvoll. Dein Feedback bestimmt,
                    was wir als Nächstes umsetzen.</p>
            </div>
            <div class="w-1/2 border-r-4 h-16 border-primary"></div>
        </div>
        <div class="flex flex-col">
            <div class="w-1/2 border-r-4 h-16 border-secondary"></div>
            <div class="border-secondary border-4 md:w-1/2 mx-auto p-8">
                <p class="text-4xl font-semibold">So gibst Du uns Feedback.</p>
                <div class="mt-2 text-2xl">
                    <p>Einen Feedback-Button findest Du auf jeder Seite.</p>
                    <p class="mt-8">Klicke auf den Button, um das Formular zu öffnen.</p>
                    <p class="mt-8">Teile uns deine Anregungen möglichst genau mit.
                        So können wir sie am Besten auswerten.</p>
                    <p class="mt-8">Beim Abschicken des Formulars wird die aktuelle Seitenadresse (URL) übermittelt.
                        Das hilft uns dabei, dein Feedback einzuordnen.</p>
                    <p class="mt-8">Wir freuen uns von Dir zu hören, egal ob Positives oder Negatives – uns interessiert
                        <span class="font-semibold">Alles</span>.</p>
                </div>
            </div>
            <div class="w-1/2 border-r-4 h-32 border-secondary"></div>
        </div>
        <p class="text-4xl font-semibold mx-auto">Und das sind wir.</p>
        <div class="flex justify-center flex-col md:flex-row">
            <x-team-card>
                <x-slot name="img">/img/team/Klaus.png</x-slot>
                <x-slot name="name">Klaus Kestel</x-slot>
                <x-slot name="role">leitet das Projekt</x-slot>
                Seit mich die Idee einmal mitten in der Nacht geweckt hat, lässt sie mich nicht mehr los.
                Ich kann nicht anders, als kontinuierlich daran zu arbeiten; alles Andere raubt mir den Schlaf.
            </x-team-card>
            <x-team-card>
                <x-slot name="img">/img/team/Theresa.png</x-slot>
                <x-slot name="name">Theresa Mages</x-slot>
                <x-slot name="role">organisiert und hat den Überblick</x-slot>
                Ich mag Neues. Durch die Mitarbeit an Teamspark erlange ich neue Fähigkeiten, lerne mehr über mich
                selbst und erhalte neue Einblicke, die nichts mit meinem Studium zu tun haben. Und auch ich werde eine
                begeisterte Userin der Plattform sein.
            </x-team-card>
        </div>
        <div class="flex justify-center">
            <x-team-card>
                <x-slot name="img">/uploads/avatar/default.jpg</x-slot>
                <x-slot name="name">Tanja Heinrich</x-slot>
                <x-slot name="role">programmiert und entwickelt</x-slot>
                Erfolgreiche Projekte entstehen, wenn man mit den richtigen Menschen darüber spricht. Teamspark hilft
                dabei, diese Menschen zu finden und als Entwicklerin liegt es mir am Herzen, das Ganze für dich so
                einfach zu machen, wie es geht.
            </x-team-card>
        </div>
        <div class="flex justify-center flex-col md:flex-row">
            <x-team-card>
                <x-slot name="img">/img/team/Matej.png</x-slot>
                <x-slot name="name">Matej Majesky</x-slot>
                <x-slot name="role">macht die UX und die Finanzen</x-slot>
                Als Teil von Teamspark möchte ich etwas wirklich Wertbringendes auf die Beine stellen, von dem viele
                Menschen in Zukunft profitieren können und das ihre Fähigkeiten sinnvoll für die Verwirklichung ihrer
                Ideen einbringt.
            </x-team-card>
            <x-team-card>
                <x-slot name="img">/uploads/avatar/default.jpg</x-slot>
                <x-slot name="name">Martin Wundsam</x-slot>
                <x-slot name="role">programmiert</x-slot>
                Die Entwicklung von der Idee bis zum fertigen Projekt zu sehen ist für mich super interessant und gibt
                unglaublich viel Erfahrung mit auf den Weg.
            </x-team-card>
        </div>
        <div class="flex justify-center flex-col md:flex-row">
            <x-team-card>
                <x-slot name="img">/img/team/David.png</x-slot>
                <x-slot name="name">David Melzer</x-slot>
                <x-slot name="role">programmiert</x-slot>
                Ich mag Code. Hier gibts Code.
            </x-team-card>
            <x-team-card>
                <x-slot name="img">/img/team/Sophie.png</x-slot>
                <x-slot name="name">Sophie Rempen</x-slot>
                <x-slot name="role">gestaltet das visuelle Design</x-slot>
                Plötzlich ist man im Team und arbeitet an was Großem. So war’s bei mir und so funktioniert Teamspark.
            </x-team-card>
        </div>
        <div class="w-full h-2 bg-primary"></div>
        <div class="w-1/6 mx-auto my-8 transform hover:rotate-180 transition duration-1000">
            <svg width="100%" height="100%" viewBox="0 0 45 45" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                 style="fill-rule:evenodd;clip-rule:evenodd;stroke-miterlimit:2;"><path
                    d="M43.421,22.455c0,11.579 -9.387,20.966 -20.966,20.966c-11.58,0 -20.966,-9.387 -20.966,-20.966c0,-11.58 9.386,-20.966 20.966,-20.966c11.579,0 20.966,9.386 20.966,20.966Z"
                    style="fill:#002859;fill-rule:nonzero;"/>
                <path
                    d="M43.421,22.455c0,11.579 -9.387,20.966 -20.966,20.966c-11.58,0 -20.966,-9.387 -20.966,-20.966c0,-11.58 9.386,-20.966 20.966,-20.966c11.579,0 20.966,9.386 20.966,20.966Z"
                    style="fill:none;stroke:#002859;stroke-width:1.33px;"/>
                <path
                    d="M26.932,5.747l-11.625,14.23l-6.086,-8.455c0,0 3.183,-3.822 7.229,-5.255c5.268,-1.865 10.482,-0.52 10.482,-0.52Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M10.969,25.359l-5.478,0.381c0,0 -0.443,-2.255 -0.208,-4.842c0.225,-2.486 1.284,-5.235 1.284,-5.235l7.954,5.221l-3.552,4.475Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M13.318,37.063c0,0 -1.528,-0.825 -3.514,-2.894c-1.745,-1.818 -2.671,-3.762 -2.671,-3.762l4.264,-4.496l8.624,-0.719l-6.703,11.871Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M19.507,39.305c0,0 -0.605,-0.031 -1.788,-0.448c-1.344,-0.474 -1.656,-0.639 -1.656,-0.639l5.57,-13.107l2.973,-0.237l-5.099,14.431Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M30.093,37.97c0,0 -2.435,1.168 -5.306,1.339c-3.341,0.199 -4.836,0.207 -4.836,0.207l5.851,-8.407l4.291,6.861Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M39.628,21.238l-5.615,-1.806l-7.844,11.192l6.417,5.766c0,0 3.98,-2.853 5.752,-7.25c1.932,-4.791 1.29,-7.902 1.29,-7.902Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M37.925,14.847c0,0 0.114,-0.48 -1.526,-2.604c-1.328,-1.722 -2.42,-2.612 -2.42,-2.612l-5.914,9.47l5.877,-0.467l3.983,-3.787Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M25.794,19.224l-4.457,0.354l5.988,-13.431c0,0 1.038,0.244 2.184,0.82c1.345,0.675 1.869,1.207 1.869,1.207l-5.584,11.05Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M39.434,22.444c0,9.303 -7.635,16.845 -17.054,16.845c-9.419,0 -17.054,-7.542 -17.054,-16.845c0,-9.304 7.635,-16.846 17.054,-16.846c9.419,0 17.054,7.542 17.054,16.846Z"
                    style="fill:none;stroke:#002859;stroke-width:1.18px;"/></svg>
        </div>
    </div>
@endsection

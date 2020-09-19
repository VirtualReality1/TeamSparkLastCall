@component('mail::message')
    # Neues Feedback

    ## {{ $details['title'] }}
    {{ $details['description'] }}

    ## Mail:
    <a href="mailto:{{ $details['mail'] }}">{{ $details['mail'] }}</a>

    ## URL:
    <a href="{{ $details['url'] }}">{{ $details['url'] }}</a>

    ### Einverständnis:
    {{ config('feedback.consent') }}
@endcomponent

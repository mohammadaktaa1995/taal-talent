@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://zoomaal.com/'])
            Zoomaal
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>You’re almost there</h2>
        <p>
            We know our registration process takes a few minutes, we hope it’ll be worth your while.
            <br/>
            your verification code is {{$verification_code}}. This code will expire on {{$expired_at}} 
        </p>
        <p>
            If you didn’t request this please <a href="mailto:hello@zoomaal.com">contact us</a> immediately
        </p>
        <p>
            Thanks,
            <br/>
            Zoomaal Team
        </p>
    </div>    

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Zoomaal. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
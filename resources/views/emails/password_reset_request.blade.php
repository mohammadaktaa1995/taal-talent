@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://zoomaal.com/'])
            Zoomaal
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <p>
            Forgot your password? that’s ok, let’s get you a new one
            <br/>
            We got a request to change the password for the account with the username {{$email}}.
            <br/>
            Your Zoomaal Account Password Reset Code is: {{$reset_code}}
        </p>
        <p>
            If you don’t want to reset your password, you can ignore this email.
            <br/>
            If you didn’t request this change, you may want to review your account security settings.
        </p>
        <p>
            All the best,
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
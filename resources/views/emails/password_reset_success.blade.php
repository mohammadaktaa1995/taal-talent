@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://zoomaal.com/'])
            Zoomaal
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h4>Your new Zoomaal password</h4>
        <p>
            Your Zoomaal password has been updated and it works like a charm. nice job.
        </p>
        <p>
            If you didn’t just reset your password, get in touch with Zoomaal so we can help secure your account. 
            Email us immediately at<a href="mailto:hello@zoomaal.com">hello@zoomaal.com</a>
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
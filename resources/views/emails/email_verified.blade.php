@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://zoomaal.com/'])
            Zoomaal
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h4>Welcome to Zoomaal!</h4>
        <p>
            Congratulations! 
            <br/>
        </p>
        <p>
            <strong>What happens next?</strong>
            ...
        </p>
        <p>
            And if you’d like to find out more, be sure to check out our <a href="https://zoomaal.com" target="_blank">website</a>.
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
@component('mail::message')
    # Hello {{$user->name}}

Thank you for create and account. Please verify your E-Mail using this link:

    @component('mail::button', ['url' => route('verify', $user->verification_token)])
        Verify Account
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

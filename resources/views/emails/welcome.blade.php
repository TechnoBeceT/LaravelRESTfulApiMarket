Hello {{$user->name}}

Thank you for create and account. Please verify your E-Mail using this link:
{{route('verify', $user->verification_token)}}

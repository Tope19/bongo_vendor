@component('mail::message')
Hello {{ $user->first_name }},

Welcome to the fastest growing Artisan community.

Our goal is to give you our user the opportunity to connect to the closest engineers in their locality and hire them. A Service Provider can also come up with the application and register and make their profile decorated as much as possible so as to interest users to patronize them.
<p>After a thorough research in the Servicing market we’ve discovered that the need of having a quick software that can bring you closest Service Provider to my location without scouting that much or having to walk distances just to get a service.
    What makes us different is that we’re focusing on the user experience needs of the application, ensuring the convenience of getting a service for those visiting the site and definitely making it as endearing as possible.</p>
@if ($referred_by_provider ?? false)

{{-- You joined through <b>{{$provider_name}}</b>. --}}

Find your account credentials below:

Email: {{$user->email}}

Password: {{$password}}

@endif

{{-- Expand your audience by inviting your friends and customers to join Lynkas with your referral code for FREE. --}}

@component('mail::button', ['url' => "https://letsgetusorted.com/login"])
    Login Now
@endcomponent

Kind regards and best wishes!<br>
{{env("APP_NAME")}}
@endcomponent

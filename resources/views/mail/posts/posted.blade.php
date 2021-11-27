@component('mail::message')
# Someone Posted

** {{ $user->username }} has posted.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

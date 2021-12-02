@component('mail::message')
    # Someone Liked

    ** {{ $user->username }} has liked one of your pictures.

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

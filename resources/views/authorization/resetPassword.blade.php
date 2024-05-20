@component('mail::message')
# Reset Password

Hi {{ $user->us_name }},

You recently requested to reset your password for your account. Please click the button below to reset your password:

@component('mail::button', ['url' => $url])
Reset Your Password
@endcomponent

If you did not request a password reset, please ignore this email or reply to let us know.

Thank you,<br>
{{ config('app.name') }}
@endcomponent
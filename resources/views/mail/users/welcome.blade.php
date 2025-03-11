<x-mail::message>
# Welcome to {{ config('app.name') }}

You can join leagues and pick for events. You can join public leagues from the home page, or with a private league code and password. Hope you enjoy it! Now go ahead and dive right in

<x-mail::button :url="route('welcome')">
Your leagues
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

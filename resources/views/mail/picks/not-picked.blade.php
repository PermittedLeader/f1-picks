<x-mail::message>
# You still haven't made your {{ trans_choice('crud.picks.plural',2) }}!

It looks like you've not made your {{ trans_choice('crud.picks.plural',1) }} for the upcoming {{ trans_choice('crud.events.plural',1) }}: {{ $event->name }}, part of the {{ trans_choice('crud.leagues.plural',1) }}: {{ $league->name }} and {{ trans_choice('crud.seasons.plural',1) }}: {{ $season->name }}.

### You need to {{ trans_choice('crud.picks.plural',1) }} by {{ $event->pick_date }}!

<x-mail::button :url="route('pick.create',['event'=>$event,'league'=>$league,'season'=>$season])">
Make your {{ trans_choice('crud.picks.plural',1) }}
</x-mail::button>
</x-mail::message>

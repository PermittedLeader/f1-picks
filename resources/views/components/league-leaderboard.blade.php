<div>
    <div class="grid grid-cols-3 gap-2">
        <div class="flex flex-col mt-auto">
            <div class="text-center text-2xl text-bold my-2">
                <ul>
                    @foreach ($top3places[2] as $ranked)
                        <li>{{ $ranked->user->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="h-20 bg-brand-dark p-2 text-white">
                <div class="text-center align-middle text-xl">
                    2
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-center text-2xl text-bold my-2">
                <ul>
                    @foreach ($top3places[1] as $ranked)
                        <li>{{ $ranked->user->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="h-24 bg-brand-mid p-2 text-white">
                <div class="text-center align-middle text-xl">
                    1
                </div>
            </div>
        </div>
        <div class="flex flex-col mt-auto">
            <div class="text-center text-2xl text-bold my-2">
                <ul>
                    @foreach ($top3places[3] as $ranked)
                        <li>{{ $ranked->user->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="h-16 bg-brand-dark p-2 text-white">
                <div class="text-center align-middle text-xl">
                    3
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-full text-center p-2 bg-secondary-mid mt-2 text-white">
        @if($userRank > 0)
        Your rank: {{ $userRank }}
        @else
        You are not part of this league, or have not picked yet.
        @endif
    </div>
</div>
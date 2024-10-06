<?php

namespace App\Livewire;

use App\Models\Season;
use Livewire\Component;
use Illuminate\Support\Str;
use Permittedleader\FlashMessages\FlashMessages;

class SeasonPickablesOrderSortable extends Component
{
    use FlashMessages;

    public Season $season;
    public array $orderedItems;

    public function mount() 
    {
        $this->orderedItems = $this->season->pickables->map(function($item, $key){
            return [
                'order'=>$key,
                'value'=>$item->id
            ];
        })->toArray();    
    }

    public function render()
    {
        return view('livewire.season-pickables-order-sortable');
    }

    public function updateOrder($orderedItems)
    {
        $this->orderedItems = $orderedItems;
    }

    public function saveUpdatedOrder()
    {
        foreach($this->orderedItems as $orderItem){
            $this->season->pickables()->updateExistingPivot($orderItem['value'],['order'=>$orderItem['order']]);
        }

        self::success(Str::title(__('crud.common.saved')));
    }
}

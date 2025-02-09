<?php

namespace App\Livewire\Season;

use App\Enums\JokerRestrictionType;
use App\Models\Season;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Permittedleader\FlashMessages\FlashMessages;

class JokerRules extends Component
{
    use FlashMessages;
    public Season $season;

    public int $pick_count;

    public $joker_restrictions;

    public string $addNewRestrictionType;

    public function mount()
    {
        $this->pick_count = $this->season->joker_pick_count;
        $this->joker_restrictions = $this->season->parse_joker_restrictions()->toArray();
    }

    #[Computed()]
    public function hasJokers():bool
    {
        return $this->season->hasJokers();
    }

    #[On('updatedPickables')]
    public function updatedPickables($restriction,$ids)
    {
        $this->joker_restrictions[$restriction] = $ids;
    }

    public function save()
    {
        $this->season->joker_pick_count = $this->pick_count;
        $this->season->set_joker_restrictions($this->joker_restrictions);

        $this->season->save();

        self::success('Saved');
    }

    public function addNew(){
        $restrictionType = JokerRestrictionType::from($this->addNewRestrictionType);
        $this->joker_restrictions[$restrictionType->value] = $restrictionType->restrictionType() == 'pickable' ? [] : false;
    }

    public function remove($key)
    {
        unset($this->joker_restrictions[$key]);
    }
}

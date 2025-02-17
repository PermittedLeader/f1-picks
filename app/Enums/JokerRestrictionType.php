<?php
namespace App\Enums;

use Permittedleader\Forms\Traits\Enums\DisplayString;

enum JokerRestrictionType: string
{
    use DisplayString;
    case ONLY_WITH_JOKER = 'only_with_joker';
    case NOT_WITH_JOKER = 'not_with_joker';
    case USE_JOKER_WITH_ANY_PICK = 'use_joker_with_any_pick';

    public function restrictionType(): string
    {
        
        return match($this){
            self::ONLY_WITH_JOKER,self::NOT_WITH_JOKER => 'pickable',
            self::USE_JOKER_WITH_ANY_PICK => 'boolean',
            default => 'pickable'
        };
    }
}
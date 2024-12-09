<?php

namespace Tasawk\Enum;

use Filament\Support\Contracts\HasLabel;

enum GroupStatus: string implements HasLabel {

    Case OBJECTIVES ='objectives';
    Case MALAHIDATA = 'malahidata';


    public function getLabel(): ?string {
        return __("panel.enums.$this->value");
    }


}


<?php

namespace Tasawk\Enum;

use Filament\Support\Contracts\HasLabel;

enum SectionStatus: string implements HasLabel {


    Case MAINOBJECTS = "mainobjects";
    Case OBJECTS = "objects";

    Case PARTNER ="partner";
    Case TOPBAR ="topbar";
    
    Case Branch = "branchs";

    Case OURRULE = "ourrule";

    Case MALAHI = "malahi";
    Case TOP = "top";

    Case MIDDEL = "middel";

    Case BOTTOM = "bottom";


    public function getLabel(): ?string {
        return __("panel.enums.$this->value");
    }


}


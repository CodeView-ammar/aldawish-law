<?php

namespace Tasawk\Enum;

use Filament\Support\Contracts\HasLabel;

enum PageStatus: string implements HasLabel
{


    case ABOUTUS = "aboutus";

    case PARTNER = "partner";
    case TAPBAR = "topbar";
    

    case OURSERVICE = "ourservice";

    case COMPANYMESSAGE = "company-message";

    case COMPANYGOALS = "company-goals";

    case TERMSCONDITION = "terms-condition";

    case PRIVACYPOLICY = "privacy-policy";


    case CAREER = "career";

    case COMPANYAIMS  = "company-aims";

    Case COMPANYVISION= "company-vision";

    Case OURVALUES= "our-values";


    case SCIENTIFICEXPERIENCES = "scientific-experiences";

    case RELEVANTCOMPANY = "relevant-company";

    case TEAMMISSION = "team-mission";


    public function getLabel(): ?string
    {
        return __("panel.enums.$this->value");
    }
}

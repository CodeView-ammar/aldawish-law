<?php

namespace Tasawk\Enum;

use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel {
    case NEW  = 'new';
    case PENDING = 'pending';
    case COMPLETED = 'completed';

    case REJECTED = 'rejected';

    public function getLabel(): ?string {
        return __("panel.enums.$this->value");
    }

    public function getColor(): string {
        return match ($this->value) {
            'new' => 'warning',
            'pending' => 'gray',
            'completed' => 'success',
            'rejected' => 'danger',
        };

    }
    public function getColorClass(): string {
        return match ($this->value) {
            'new' => 'new',
            'pending' => 'current',
            'completed' => 'completed',
            'rejected' => 'canceled',
        };

    }

}

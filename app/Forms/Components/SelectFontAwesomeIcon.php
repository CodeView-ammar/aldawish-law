<?php

namespace Tasawk\Forms\Components;

use Tasawk\Lib\FontawesomeIcons;
use Filament\Forms\Components\Select;

class SelectFontAwesomeIcon extends Select {

    protected string $mode = 'social';
    protected string $view = 'forms.components.select-font-awesome-icon';

    public function getOptions(): array {

        return FontawesomeIcons::make()->setMode($this->mode)->toSelect();
    }

    public function getMode(): string {
        return $this->mode;
    }

    public function setMode(string $mode): static {
        $this->mode = $mode;
        return $this;
    }
}

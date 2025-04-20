<?php

namespace Tasawk\Filament\Resources\Content\BannerResource\Pages;

use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Tasawk\Filament\Resources\Catalog\OptionResource;
use Tasawk\Filament\Resources\Content\BannerResource;
use Filament\Actions;

class CreateBanner extends CreateRecord {
    use Translatable;

    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array {

        return [
           Actions\LocaleSwitcher::make(),
        ];
    }


    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }

}


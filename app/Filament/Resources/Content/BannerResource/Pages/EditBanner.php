<?php

namespace Tasawk\Filament\Resources\Content\BannerResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Tasawk\Filament\Resources\Content\BannerResource;
use Filament\Actions;

class EditBanner extends EditRecord {
    use EditRecord\Concerns\Translatable;

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

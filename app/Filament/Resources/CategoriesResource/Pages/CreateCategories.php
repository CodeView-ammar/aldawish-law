<?php

namespace Tasawk\Filament\Resources\CategoriesResource\Pages;

use Tasawk\Filament\Resources\CategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategories extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected static string $resource = CategoriesResource::class;
}

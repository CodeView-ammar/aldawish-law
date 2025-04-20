<?php

namespace Tasawk\Filament\Resources\CategoriesResource\Pages;

use Tasawk\Filament\Resources\CategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategories extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(), // إضافة أداة تبديل اللغة
            Actions\DeleteAction::make(), // إضافة زر الحذف
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");
    }
}
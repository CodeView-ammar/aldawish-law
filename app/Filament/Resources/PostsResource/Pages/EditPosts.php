<?php

namespace Tasawk\Filament\Resources\PostsResource\Pages;

use Tasawk\Filament\Resources\PostsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPosts extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PostsResource::class;

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
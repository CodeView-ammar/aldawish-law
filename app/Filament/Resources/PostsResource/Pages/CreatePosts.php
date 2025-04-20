<?php

namespace Tasawk\Filament\Resources\PostsResource\Pages;

use Tasawk\Filament\Resources\PostsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePosts extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected static string $resource = PostsResource::class;

}

<?php

namespace Tasawk\Filament\Shared\Schema;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
class UserSchema {
    static public function make() {
        return new static();
    }

    public function toArray() {
        return [
            SpatieMediaLibraryFileUpload::make('avatar')
                ->columnSpan(['xl' => 2])
                ->nullable(),

            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->required()
                ->email()
                ->autocomplete("off")
                ->columnSpan(['sm' => 2, 'xl' => 1])
                ->unique(ignoreRecord: true),
            PhoneInput::make('phone')
                ->required()
                ->live()
                ->defaultCountry('SA')
                ->columnSpan(['sm' => 2])
                ->validateFor(
                    type: PhoneNumberType::MOBILE,
                    lenient: true
                )
                ->unique(ignoreRecord: true)
                ->displayNumberFormat(PhoneInputNumberType::E164),
            TextInput::make('password')
                ->password()
                ->required(fn(string $operation): bool => $operation === 'create')
                ->confirmed()
                ->autocomplete("new-password"),
            TextInput::make('password_confirmation')
                ->password()
                ->required(fn(string $operation): bool => $operation === 'create')
                ->autocomplete("off"),

            Toggle::make('active')->default(1)
                ->onColor('success')
                ->offColor('danger')
        ];
    }



    public static function __callStatic(string $name, array $arguments) {
     return (new static)->toArray();
    }
}

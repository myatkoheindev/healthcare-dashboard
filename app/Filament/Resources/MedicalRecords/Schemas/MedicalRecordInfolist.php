<?php

namespace App\Filament\Resources\MedicalRecords\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MedicalRecordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('medical_image')
                    ->disk('public')
                    ->columnSpanFull()
                    ->imageWidth(200)
                    ->imageHeight(100)
                    ->imageSize(300),
                TextEntry::make('ocr_text')->columnSpanFull(),
                TextEntry::make('medical_entity')
                    ->formatStateUsing(function ($state): string {
                        if (is_array($state)) {
                            return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                        }

                        if (is_string($state)) {
                            $decoded = json_decode($state, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                return json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                            }
                        }

                        return (string) $state;
                    })
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'white-space: pre-wrap; font-family: monospace;']),

                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}

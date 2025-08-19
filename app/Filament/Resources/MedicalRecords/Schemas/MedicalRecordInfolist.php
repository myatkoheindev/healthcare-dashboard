<?php

namespace App\Filament\Resources\MedicalRecords\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use PepperFM\FilamentJson\Columns\JsonColumn;

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

                // JsonColumn::make('medical_entity')->columnSpanFull(),
                // JsonColumn::make('medical_entity')
                //     ->asTree()
                //     ->inDrawer(),

                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}

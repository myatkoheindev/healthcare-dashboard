<?php

namespace App\Filament\Resources\MedicalRecords\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class MedicalRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('medical_image')
                    ->label('Upload Medical Document')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                    ->disk('public')
                    ->directory('medical_uploads')
                    ->maxSize(10240),
            ]);
    }
}

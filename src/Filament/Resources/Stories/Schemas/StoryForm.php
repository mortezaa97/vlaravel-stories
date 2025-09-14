<?php

declare(strict_types=1);

namespace Mortezaa97\Stories\Filament\Resources\Stories\Schemas;

use Filament\Schemas\Schema;

class StoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([
                            \App\Filament\Components\Form\TitleTextInput::create(),
                            \App\Filament\Components\Form\SlugTextInput::create(),
                            \App\Filament\Components\Form\DescriptionTextarea::create(),
                            \App\Filament\Components\Form\CoverFileUpload::create(),
                            \App\Filament\Components\Form\ImageFileUpload::create(),
                            \App\Filament\Components\Form\VideoFileUpload::create(),
                            \App\Filament\Components\Form\UrlTextInput::create(),
                            \App\Filament\Components\Form\UserSelect::create()->required(),
                            \App\Filament\Components\Form\ParentSelect::create(),
                            \App\Filament\Components\Form\StatusSelect::create(),
                            \App\Filament\Components\Form\CreatedBySelect::create()->required(),
                            \App\Filament\Components\Form\UpdatedBySelect::create(),

                        ])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(8),
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(4),
        ])
            ->columns(12);
    }
}

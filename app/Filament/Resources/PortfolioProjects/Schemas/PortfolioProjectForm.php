<?php

namespace App\Filament\Resources\PortfolioProjects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('title')
                            ->label('Название проекта')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, $record) {
                                if (! $record) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('URL (Slug)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Textarea::make('short_description')
                            ->label('Краткое описание')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Полное описание')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Изображение и технологии')
                    ->schema([
                        FileUpload::make('cover_image')
                            ->label('Обложка проекта')
                            ->image()
                            ->disk('public')
                            ->directory('portfolio')
                            ->visibility('public'),

                        TagsInput::make('technologies')
                            ->label('Технологии')
                            ->placeholder('Добавить технологию')
                            ->columnSpanFull(),
                    ]),

                Section::make('Ссылки')
                    ->schema([
                        TextInput::make('website_url')
                            ->label('Ссылка на сайт')
                            ->url(),

                        TextInput::make('github_url')
                            ->label('GitHub')
                            ->url(),
                    ])
                    ->columns(2),

                Section::make('Публикация')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Порядок сортировки')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_published')
                            ->label('Опубликовать проект')
                            ->default(false),
                    ])
                    ->columns(2),

            ]);
    }
}

<?php

namespace App\Filament\Resources\PortfolioProjects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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

                        Repeater::make('images')
                            ->label('Галерея проекта')
                            ->relationship()
                            ->schema([
                                FileUpload::make('image_path')
                                    ->label('Изображение')
                                    ->image()
                                    ->disk('public')
                                    ->directory('portfolio/gallery')
                                    ->visibility('public')
                                    ->required(),

                                Select::make('image_type')
                                    ->label('Тип изображения')
                                    ->options([
                                        'desktop' => 'Десктопная версия',
                                        'mobile' => 'Мобильная версия',
                                        'photo' => 'Фотография проекта',
                                        'other' => 'Другое',
                                    ])
                                    ->default('desktop')
                                    ->required(),
                            ])
                            ->orderColumn('sort_order')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => match ($state['image_type'] ?? null) {
                                'desktop' => 'Десктопная версия',
                                'mobile' => 'Мобильная версия',
                                'photo' => 'Фотография проекта',
                                'other' => 'Другое',
                                default => 'Изображение',
                            })
                            ->addActionLabel('Добавить изображение')
                            ->columnSpanFull(),

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

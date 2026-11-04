<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Facades\Cache;

class SiteSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::first();

        $this->form->fill($settings?->toArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('Заголовок')
                            ->maxLength(255),

                        Textarea::make('hero_description')
                            ->label('Описание')
                            ->rows(3),
                    ]),

                Section::make('Обо мне')
                    ->schema([
                        Textarea::make('about_description')
                            ->label('Описание')
                            ->rows(5),

                        FileUpload::make('about_photo')
                            ->label('Фотография')
                            ->image()
                            ->disk('public')
                            ->directory('public/images')
                            ->visibility('public')
                    ]),

                Section::make('Контакты')
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->placeholder('example@mail.com'),

                        TextInput::make('contact_phone')
                            ->label('Телефон')
                            ->tel()
                            ->placeholder('+7 999 123-45-67'),

                        TextInput::make('contact_telegram')
                            ->label('Telegram')
                            ->placeholder('https://t.me/username'),

                        TextInput::make('contact_whatsapp')
                            ->label('WhatsApp')
                            ->placeholder('https://wa.me/79991234567'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = SiteSetting::query()->first() ?? new SiteSetting();

        $settings->fill($data);
        $settings->save();

        Cache::forget('site_settings');

        $this->form->fill($settings->toArray());

        \Filament\Notifications\Notification::make()
            ->title('Настройки сохранены')
            ->success()
            ->send();
    }
}

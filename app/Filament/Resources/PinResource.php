<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PinResource\Pages;
use App\Filament\Resources\PinResource\RelationManagers;
use App\Models\Pin;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PinResource extends Resource
{
    protected static ?string $model = Pin::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $modelLabel = 'Pin';
    protected static ?string $pluralModelLabel = 'Pins';

    public static function getEloquentQuery(): Builder
    {
        // return parent::getEloquentQuery()->where('is_active', true);
        // only view own pins
        if(!auth()->user()->hasRole('Admin')) {
            return parent::getEloquentQuery()->where('user_id', auth()->id());
        }
        return parent::getEloquentQuery();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()
                    ->persistTabInQueryString()
                    ->columnSpanFull()
                    ->schema([
                        Tab::make('Algemeen')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Forms\Components\Select::make('status')
                                ->options([
                                    'draft' => 'Concept',
                                    'published' => 'Gepubliceerd',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Get $get, Set $set) => $set('slug', \Illuminate\Support\Str::slug($get('title')) ))
                                ->maxLength(255),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->maxLength(255),
                            Select::make('categories')
                                ->relationship(titleAttribute: 'name')
                                ->multiple()
                                ->preload()
                                ->required(),
                            SpatieTagsInput::make('tags')
                                ->hint('Klik op tab om een tag toe te voegen'),
                            Forms\Components\Textarea::make('short_description')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('description')
                                ->required()
                                ->rows(5)
                                ->columnSpanFull(),
                                ]),
                        Tab::make('Vragenlijst')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Fieldset::make('Vragenlijst')
                                    ->columns(1)
                                    ->relationship('pinMeta')
                                    ->schema([
                                        TextInput::make('school_name')
                                            ->label('Naam school'),
                                        TextInput::make('school_location')
                                            ->label('Locatie in schoolgebouw'),
                                        DatePicker::make('datum_gebruikname')
                                            ->displayFormat('Y')
                                            ->label('Datum gebruikname'),
                                        Textarea::make('reden_bijzonderheid')
                                            ->label('Waarom deze pin?'),
                                        Textarea::make('meningen')
                                            ->label('Wat gebruikers er over zeggen'),
                                        Textarea::make('primair_doel')
                                            ->label('Waar wordt het voornamelijk voor gebruikt?'),
                                        Textarea::make('bijzonderheden')
                                            ->label('Overige bijzonderheden?'),
                                        Textarea::make('betrokkenen')
                                            ->label('Overige betrokkenen'),
                                    ])
                            ]),
                        Tab::make('Afbeeldingen')
                            ->icon('heroicon-o-photo')
                            ->columns(2)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Hoofdafbeelding')
                                    ->image()
                                    ->columns(1)
                                    ->collection('main_image'),
                                SpatieMediaLibraryFileUpload::make('images')
                                    ->label('Overige afbeeldingen')
                                    ->image()
                                    ->collection('images')
                                    ->multiple()
                                    ->columnSpanFull(),
                            ]),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('main_image')
                    ->label('Hoofdafbeelding')
                    ->collection('main_image'),

                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPins::route('/'),
            'create' => Pages\CreatePin::route('/create'),
            'edit' => Pages\EditPin::route('/{record}/edit'),
        ];
    }
}

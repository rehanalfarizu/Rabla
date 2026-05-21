<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;
    protected static ?string $navigationLabel = 'Promotions';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?string $modelLabel = 'Promotion';
    protected static ?string $pluralModelLabel = 'Promotions';

    public static function getNavigationIcon(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'heroicon-o-sparkles';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Info')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->unique(ignoreRecord: true)
                            ->placeholder('AUTO-GENERATED'),
                        Forms\Components\Select::make('type')
                            ->options(Promotion::getTypeOptions())
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(500),
                    ])->columns(2),

                Forms\Components\Section::make('Discount')
                    ->schema([
                        Forms\Components\Select::make('discount_type')
                            ->options([
                                'percentage' => 'Percentage (%)',
                                'fixed' => 'Fixed Amount (Rp)',
                                'freeship' => 'Free Shipping',
                            ])->required(),
                        Forms\Components\TextInput::make('discount_value')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('max_discount')
                            ->numeric()
                            ->label('Max Discount (Rp)'),
                        Forms\Components\TextInput::make('min_purchase')
                            ->numeric()
                            ->label('Min. Purchase (Rp)')
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Duration')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Usage Limits')
                    ->schema([
                        Forms\Components\TextInput::make('max_uses')
                            ->numeric()
                            ->label('Max Total Uses'),
                        Forms\Components\TextInput::make('per_user_limit')
                            ->numeric()
                            ->label('Max Uses Per User'),
                        Forms\Components\TextInput::make('used_count')
                            ->numeric()
                            ->disabled(),
                    ])->columns(3),

                Forms\Components\Section::make('Targeting')
                    ->schema([
                        Forms\Components\Toggle::make('is_public')
                            ->label('Public (visible to all users)')
                            ->default(true),
                        Forms\Components\Select::make('applicable_categories')
                            ->relationship('category', 'name')
                            ->multiple()
                            ->searchable()
                            ->label('Applicable Categories'),
                        Forms\Components\TagsInput::make('applicable_products')
                            ->label('Applicable Products (IDs)'),
                    ])->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        Forms\Components\TextInput::make('priority')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->copyable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('discount_value')
                    ->formatStateUsing(fn ($state, $record) => $record->discount_type === 'percentage'
                        ? $state . '%'
                        : 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('min_purchase')
                    ->formatStateUsing(fn ($state) => $state > 0
                        ? 'Min Rp ' . number_format($state, 0, ',', '.')
                        : 'No minimum'),
                Tables\Columns\TextColumn::make('used_count')
                    ->label('Used'),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime('d M Y'),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime('d M Y'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(Promotion::getTypeOptions()),
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_active')
                    ->icon(fn ($record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->action(fn ($record) => $record->update(['is_active' => !$record->is_active])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'view' => Pages\ViewPromotion::route('/{record}'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
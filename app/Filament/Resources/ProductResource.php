<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $modelLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Products';

    public static function getNavigationIcon(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'heroicon-o-shopping-bag';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Info')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated(),
                                Forms\Components\Textarea::make('short_description')
                                    ->maxLength(500),
                                Forms\Components\RichEditor::make('description'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Pricing & Stock')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp'),
                                Forms\Components\TextInput::make('compare_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->label('Compare At Price'),
                                Forms\Components\TextInput::make('cost_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->label('Cost Price'),
                                Forms\Components\TextInput::make('sku')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('stock')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('low_stock_threshold')
                                    ->numeric()
                                    ->default(10)
                                    ->label('Low Stock Alert'),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Category & Variants')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable(),
                                Forms\Components\TextInput::make('sizes')
                                    ->label('Available Sizes (comma separated)')
                                    ->placeholder('S, M, L, XL'),
                                Forms\Components\TextInput::make('colors')
                                    ->label('Available Colors (comma separated)')
                                    ->placeholder('Red, Blue, Black'),
                                Forms\Components\TagsInput::make('tags')
                                    ->label('Product Tags'),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                Forms\Components\FileUpload::make('images')
                                    ->multiple()
                                    ->image()
                                    ->directory('products'),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('seo_description')
                                    ->maxLength(500),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('Meta Keywords'),
                            ]),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured'),
                        Forms\Components\Toggle::make('is_new')
                            ->label('New Arrival'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('sold_count')
                    ->label('Sold'),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Views'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
                Tables\Filters\SelectFilter::make('is_featured')
                    ->options([
                        '1' => 'Featured',
                        '0' => 'Not Featured',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Update Status')
                        ->form([
                            Forms\Components\Toggle::make('is_active')->label('Active'),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => $data['is_active']]);
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
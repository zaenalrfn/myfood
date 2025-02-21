<?php

namespace App\Filament\Resources\BarcodeResource\Pages;

use App\Filament\Resources\BarcodeResource;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Barcode;

class CreateQr extends Page
{

    protected static string $resource = BarcodeResource::class;
    protected static string $view = 'filament.resources.barcode-resource.pages.create-qr';

    public $table_number;

    public function mount(): void
    {
        $this->form->fill();
        $this->table_number = strtoupper(chr(rand(65, 90)) . rand(1000, 9999));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('table_number')
                    ->required()
                    ->default(fn() => $this->table_number)
                    ->disabled(),
            ]);
    }

    public function save(): void
    {
        $host = $_SERVER["HTTP_HOST"] . "/" . $this->table_number;

        // generate the qrcode as an svg image
        $svgContent = QrCode::margin(1)->size(200)->generate($host);

        // define the path of the svg file
        $svgfilePath = 'qr_codes/' . $this->table_number . '.svg';

        // save to storage laravel
        Storage::disk('public')->put($svgfilePath, $svgContent);

        Barcode::create([
            'table_number' => $this->table_number,
            'users_id' => Auth::user()->id,
            'image' => $svgfilePath,
            'qr_value' => $host
        ]);

        // send notification success
        Notification::make()
            ->title('QR Code Created')
            ->success()
            ->icon('heroicon-o-check-circle')
            ->send();

        // redirect to barcode list
        $this->redirect(url('admin/barcodes'));
    }
}

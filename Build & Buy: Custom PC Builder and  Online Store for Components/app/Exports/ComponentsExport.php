<?php

namespace App\Exports;

use App\Models\Component;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComponentsExport implements FromCollection, WithHeadings
{
    protected $type;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function collection()
    {
        return $this->type ? Component::where('type', $this->type)->get() : Component::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Type',
            'Brand',
            'Price',
            'Stock Quantity',
            'Created At',
            'Updated At',
        ];
    }
}

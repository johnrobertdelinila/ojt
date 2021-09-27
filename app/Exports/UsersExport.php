<?php

namespace App\Exports;

use App\User;
use App\PAR;
use App\Inventory;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    use Exportable;

    public function __construct(string $variable_name1, string $variable_name2)
    {
        // $this->variable_name1 = $variable_name1;
        // $this->variable_name2 = $variable_name2;
        $this->variable_name1 = '2019-01-01';
        $this->variable_name2 = '2019-12-31';
    }

    public function query()
    {
        return Inventory::query()->
        select(
            'inv_name',
            'inv_prop_no',
            'inv_desc','inv_date_acq',
            'inv_serial',
            'inv_locator',
            'inv_unit_value',
            'inv_total_value',
            'inv_netbook_value'
        )
        // ->where('id','>=',$this->variable_name2);
        ->whereBetween('inv_date_acq',[$this->variable_name1,$this->variable_name2]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Property No.',
            'Description',
            'Date Acquired',
            'Serial',
            'Locator',
            'Unit Value',
            'Total Value',
            'Netbook Value',
        ];
    }
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //         },
    //     ];
    // }
}
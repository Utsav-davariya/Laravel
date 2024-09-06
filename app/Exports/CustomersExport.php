<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Return all customers data as a collection
        return Customer::all(['name', 'email', 'address', 'state', 'country', 'dob', 'status']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Address',
            'State',
            'Country',
            'Date of Birth',
            'Status'
        ];
    }
}

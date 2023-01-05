<?php

namespace App\Exports;

//use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostExport implements FromCollection, WithHeadings
{	
	private $data;
    public function __construct($data,$heading=[])
    {
        $this->data = $data;
        $this->heading = $heading;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        return collect($this->data);

    }
    public function headings(): array
    {
        return $this->heading;
    }   
}

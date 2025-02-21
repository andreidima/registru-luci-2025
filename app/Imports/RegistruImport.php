<?php

namespace App\Imports;

use App\Models\Registru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RegistruImport implements ToModel, WithStartRow
{
    /**
     * Specify that the import should start at row 2.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Transform each row into a Registru model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Registru([
            'A' => $row[0],
            'B' => $row[1],
            'C' => $row[2],
            'D' => $row[3],
            'E' => $row[4],
            'F' => $row[5],
            'G' => $row[6],
            'H' => $row[7],
            'I' => $row[8],
            'J' => $row[9],
            'K' => $row[10],
            'L' => $row[11],
            'M' => $row[12],
            'N' => $row[13],
            'O' => $row[14],
            'P' => $row[15],
            'Q' => $row[16],
            'R' => $row[17],
            'S' => $row[18],
            'T' => $row[19],
            'U' => $row[20],
            'V' => $row[21],
            'W' => $row[22],
        ]);
    }
}


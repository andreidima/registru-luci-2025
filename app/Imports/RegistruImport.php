<?php

namespace App\Imports;

use App\Models\Registru;
use App\Models\UsageLog;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class RegistruImport implements ToModel, WithStartRow, SkipsEmptyRows, WithValidation, SkipsOnFailure, WithEvents
{
    /**
     * ID of the UsageLog record to update
     *
     * @var int
     */
    protected $logId;

    /**
     * Raw rows buffer for computing counts_by_b
     *
     * @var array<int, array>
     */
    protected $rawRows = [];

    /**
     * Counters for imported and skipped rows
     */
    protected $imported = 0;
    protected $skipped  = 0;

    /**
     * Inject the log ID so we can update it after import
     */
    public function __construct(int $logId)
    {
        $this->logId = $logId;
    }

    /**
     * Start import at the second row (skip headers)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Map each row to a Registru model, tracking raw rows and skipping those with empty column B
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Collect the raw row for counts_by_b
        $this->rawRows[] = $row;

        // Skip rows where column B (index 1) is empty
        if (empty($row[1])) {
            $this->skipped++;
            return null;
        }

        $this->imported++;
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

    /**
     * Validation rules: require column B in every row
     */
    public function rules(): array
    {
        return [
            '*.1' => 'required',
        ];
    }

    /**
     * Handle validation failures: flash these back to the session
     *
     * @param Failure ...$failures
     */
    public function onFailure(Failure ...$failures)
    {
        session()->flash('import_failures', $failures);
    }

    /**
     * Register events to update the UsageLog after import finishes
     */
    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                // Build counts_by_b map
                $map = [];
                foreach ($this->rawRows as $row) {
                    $b = $row[1] ?? '';
                    if ($b === '') {
                        continue;
                    }
                    if (! isset($map[$b])) {
                        $map[$b] = 0;
                    }
                    $map[$b]++;
                }

                // Update the UsageLog record
                UsageLog::find($this->logId)
                    ->update([
                        'status'        => 'success',
                        'rows_imported' => $this->imported,
                        'rows_skipped'  => $this->skipped,
                        'counts_by_b'   => $map,
                    ]);
            },
        ];
    }
}

<?php
namespace App\Imports;

use DB;
use App\Models\FileRow;
use App\Models\RowData;
use App\Models\FileHeading;
use Illuminate\Support\Collection;
use App\Repository\Eloquent\BaseRepository;
use Maatwebsite\Excel\Concerns\ToCollection;

class Import implements ToCollection
{

    private $file_id;
    private $rowRepository;
    private $fileRepository;
    private $headingRepository;
    private $rowDataRepository;

    public function __construct($file_id, $fileRepository) 
    {
        $this->file_id = $file_id;
        $this->fileRepository = $fileRepository;
        $this->rowRepository = new BaseRepository(new FileRow());
        $this->headingRepository = new BaseRepository(new FileHeading());
        $this->rowDataRepository = new BaseRepository(new RowData());
    }

    /**
     * @param array $row
     *
     * @return File|null
     */
    public function collection(Collection $rows)
    {
        $headings=[]; $file_rows=[]; $rows_date=[];
        
        foreach ($rows as $index => $row)
        {
            if($index == 0){

                foreach ($row as $h) {
                    $headings[]=[
                        'file_id' => $this->file_id,
                        'name' => $h,
                    ];
                }

                $this->headingRepository->insert($headings);

            }else{

                $row_id = $this->rowRepository->create([ 'file_id'=>$this->file_id ])->id;
                $rows_date = [];
                
                foreach ($row as $value) {
                    $rows_date[]=[
                        'file_row_id' => $row_id,
                        'value' => $value,
                    ];
                }

            $this->rowDataRepository->insert($rows_date);


            }

            // $this->rowDataRepository->insert($rows_date);

        }

        // DB::rollBack();
        DB::commit();

        return true;

    }
}
<?php
namespace App\Services;

use App\Repository\Eloquent\BaseRepository;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use App\Models\FileRow;
use Session;
use DB;

class FileService extends Controller {

    private $rowRepository;

    public function __construct() 
    {
        $this->rowRepository = new BaseRepository(new FileRow());
    }

    public function import($file, $repository)
    {
        DB::beginTransaction();

        $file_name = $file->getClientOriginalName();
        $id = $repository->create(['name'=>$file_name])->id;

        $response = Excel::import(new Import($id, $repository), $file);

        Session::flash('success_message', 'Uploaded Successfully!');
        return redirect('files');
    }

    public function get($search, $id, $repository)
    {
        $file = $repository->findById($id,['*'],['headings']);
        $data = $this->rowRepository->withPagination(['file_id'=>$id], ['*'], ['rowsData']);
        $data['file'] = $file;

        return view('show', $data);
    }

}
<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Platform;  
 
use Maatwebsite\Excel\Facades\Excel;
class MaatwebsiteDemoController extends Controller  
{  
    public function importExport()  
    {  
        return view('importExport');  
    }  
    public function downloadExcel($type)  
    {  
        $data = Platform::get()->toArray();  
        return Excel::create('platforms', function($excel) use ($data) {  
            $excel->sheet('mySheet', function($sheet) use ($data)  
            {  
                $sheet->fromArray($data);  
            });  
        })->download($type);  
    }  
    public function importExcel()  
    {  
        if(Input::hasFile('import_file')){  
            $path = Input::file('import_file')->getRealPath();  
            $data = Excel::load($path, function($reader) {  
            })->get();  
            if(!empty($data) && $data->count()){  
                foreach ($data as $key => $value) {  
                    $insert[] = ['name' => $value->title, 'description' => $value->description];  
                }  
                if(!empty($insert)){  
                    DB::table('platforms')->insert($insert);  
                    dd('Insert Record successfully.');  
                }  
            }  
        }  
        return back();  
    }  
}  
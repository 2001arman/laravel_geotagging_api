<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Holiday;
use App\Models\Izin;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request){
        $input = $request->all();

        $pegawai = Pegawai::where('email', $input['email'])->first();

        if($pegawai == null){
            $response = [
                'code' => 200,
                'status' => 'failed',
                'message' => 'Email yang anda masukkan salah'
            ];
            return response()->json($response, 200);
        } else{
            if(Hash::check($input['password'], $pegawai->password)){
                $response = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => '',
                    'pegawai' => $pegawai,
                ];
                return response()->json($response, 200);
            } else{
                $response = [
                    'code' => 200,
                    'status' => 'failed',
                    'message' => 'Password yang anda masukkan salah'
                ];
                return response()->json($response, 200);
            }
        }
    }

    public function cuti(Request $request){
        $input = $request->all();

        try {
            DB::beginTransaction();
            $cuti =  Cuti::create($input);
            
            if($cuti != null){
                $response = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Berhasil mengajukan cuti'
                ];
            DB::commit();
            return response()->json($response, 200);

            } else{
                $response = [
                    'code' => 200,
                    'status' => 'failed',
                    'message' => 'Something wrong'
                ];
                DB::rollBack();
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            $response = [
                'code' => 200,
                'status' => 'failed',
                'message' => $th->getMessage(),
            ];
            DB::rollBack();
            return response()->json($response, 200);
        }
    }

    public function izin(Request $request){
        $input = $request->all();

        try {
            DB::beginTransaction();
            $izin =  Izin::create($input);
            
            if($izin != null){
                $response = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Berhasil mengajukan izin'
                ];
            DB::commit();
            return response()->json($response, 200);

            } else{
                $response = [
                    'code' => 200,
                    'status' => 'failed',
                    'message' => 'Something wrong'
                ];
                DB::rollBack();
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            $response = [
                'code' => 200,
                'status' => 'failed',
                'message' => $th->getMessage(),
            ];
            DB::rollBack();
            return response()->json($response, 200);
        }
    }

    public function absen(Request $request){
        $input = $request->all();

        try {
            DB::beginTransaction();
            $absensi = Absensi::where('id_pegawai', $input['id_pegawai'])->whereDate('created_at', Carbon::today())->first();
            // $absensi = null;
            if($absensi == null){
                $absen =  Absensi::create($input);
                
                if($absen != null){
                    $response = [
                        'code' => 200,
                        'status' => 'success',
                        'message' => 'Berhasil melakukan presensi'
                    ];
                DB::commit();
                return response()->json($response, 200);
    
                } else{
                    $response = [
                        'code' => 200,
                        'status' => 'failed',
                        'message' => 'Something wrong'
                    ];
                    DB::rollBack();
                    return response()->json($response, 200);
                }
            } else{
                $response = [
                    'code' => 200,
                    'status' => 'failed',
                    'message' => 'Anda sudah absen hari ini'
                ];
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            $response = [
                'code' => 200,
                'status' => 'failed',
                'message' => $th->getMessage(),
            ];
            DB::rollBack();
            return response()->json($response, 200);
        }
    }

    public function riwayatAbsensi($id){
        // Set the timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
        
        $absensi = Absensi::where('id_pegawai', $id)->orderBy('created_at', 'desc')->get();

        // Convert the datetime values to 'Asia/Jakarta' timezone
        foreach ($absensi as $record) {
            $record->created_at = $record->created_at->addHours(8);
            $record->updated_at = $record->updated_at->addHours(8);
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'data' => $absensi,
        ];

        return response()->json($response, 200);
    }
    
    public function getDataHoliday(){
        $holiday = Holiday::get();

        $response = [
            'code' => 200,
            'status' => "success",
            "data" => $holiday,
        ];

        return response()->json($response, 200);
    }
}

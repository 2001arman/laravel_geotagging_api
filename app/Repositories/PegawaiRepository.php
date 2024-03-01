<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Pegawai;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class MedicineRepository
 *
 * @version February 12, 2020, 11:00 am UTC
 */
class PegawaiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function getDataDivisi(): array
    {
        $data['divisis'] = [
            'IT' => 'IT',
            'Keuangan' => 'Keuangan',
            'Staff' => 'Staff',
        ];
        $data['genders'] = [
            '1' => 'Laki-laki',
            '2' => 'Perempuan',
        ];
        return $data;
    }

    public function store(array $input)
    {
        try {
            DB::beginTransaction();
            $input['email'] = setEmailLowerCase($input['email']);
            $input['password'] = Hash::make($input['password']);
            $doctor = Pegawai::create($input);
            DB::commit();

            return $doctor;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pegawai::class;
    }
}

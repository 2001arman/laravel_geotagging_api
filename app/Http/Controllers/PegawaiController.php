<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePegawaiRequest;
use App\Models\Pegawai;
use App\Repositories\PegawaiRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class PegawaiController extends AppBaseController
{
    /** @var PegawaiRepository */
    private $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepo)
    {
        $this->pegawaiRepository = $pegawaiRepo;
    }

    /**
     * Display a listing of the Pegawai.
     *
     * @param  Request  $request
     * @return Factory|View|Response
     *
     * @throws Exception
     */
    public function index(): View
    {
        return view('pegawai.index');
    }

    public function presensiIndex(){
        return view('presensi.index');
    }

    public function izinIndex(){
        return view('izin.index');
    }

    public function cutiIndex(){
        return view('cuti.index');
    }

    /**
     * Show the form for creating a new Pegawai.
     *
     * @return Factory|View
     */
    public function create(): View
    {
        $data = $this->pegawaiRepository->getDataDivisi();
        return view('pegawai.create')->with($data);
    }

    /**
     * Store a newly created Pegawai in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePegawaiRequest $request): RedirectResponse
    {
        $input = $request->all();

        $this->pegawaiRepository->store($input);

        Flash::success('Berhasil membuat data pegawai');

        return redirect(route('pegawai.index'));
    }

    /**
     * Display the specified Pegawai.
     *
     * @return Factory|View
     */
    public function show(Pegawai $medicine): View
    {
        $medicine->brand;
        $medicine->category;

        return view('pegawai.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Pegawai.
     *
     * @return Factory|View
     */
    public function edit(Pegawai $pegawai): View
    {
        $data = $this->pegawaiRepository->getDataDivisi();
        $data['pegawai'] = $pegawai;

        return view('pegawai.edit')->with($data);
    }

    /**
     * Update the specified Pegawai in storage.
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Pegawai $medicine, CreatePegawaiRequest $request): RedirectResponse
    {
        $this->pegawaiRepository->update($request->all(), $medicine->id);

        Flash::success(__('messages.medicine.medicine').' '.__('messages.medicine.updated_successfully'));

        return redirect(route('pegawai.index'));
    }

    /**
     * Remove the specified Pegawai from storage.
     *
     *
     * @throws Exception
     */
    public function destroy(Pegawai $medicine): JsonResponse
    {
        if (! canAccessRecord(Pegawai::class, $medicine->id)) {
            return $this->sendError(__('messages.flash.medicine_not_found'));
        }
        $this->pegawaiRepository->delete($medicine->id);

        return $this->sendSuccess(__('messages.medicine.medicine').' '.__('messages.medicine.deleted_successfully'));
    }

    /**
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(Pegawai $medicine): JsonResponse
    {
        $medicine->load(['brand', 'category']);

        $currency = $medicine->currency_symbol ? strtoupper($medicine->currency_symbol) : strtoupper(getCurrentCurrency());
        $medicine = [
            'name' => $medicine->name,
            'brand_name' => $medicine->brand->name,
            'category_name' => $medicine->category->name,
            'salt_composition' => $medicine->salt_composition,
            'side_effects' => $medicine->side_effects,
            'created_at' => $medicine->created_at,
            'selling_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'buying_price' => getCurrencyFormat(getCurrencyCode(), $medicine->buying_price),
            'updated_at' => $medicine->updated_at,
            'description' => $medicine->description,
            'quantity' => $medicine->quantity,
            'available_quantity' => $medicine->available_quantity,
        ];

        return $this->sendResponse($medicine, 'Pegawai Retrieved Successfully');
    }
}

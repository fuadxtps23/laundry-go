<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\ServiceRequest;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends StaffController
{
    public function index(): View
    {
        return $this->staffView('staff.services.index', [
            'services' => Layanan::withCount('transactions')->latest('nama_layanan')->paginate(12),
        ]);
    }

    public function show(Layanan $layanan): View
    {
        return $this->staffView('staff.services.show', [
            'service' => $layanan->loadCount('transactions'),
        ]);
    }

    public function create(): View
    {
        return $this->staffView('staff.services.create');
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        Layanan::create($request->validated() + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route($this->role().'.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan): View
    {
        return $this->staffView('staff.services.edit', compact('layanan'));
    }

    public function update(ServiceRequest $request, Layanan $layanan): RedirectResponse
    {
        $layanan->update($request->validated() + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route($this->role().'.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan): RedirectResponse
    {
        if ($layanan->transactions()->exists()) {
            return back()->with('error', 'Layanan tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\KaryawanRequest;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends StaffController
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));
        $employees = Karyawan::query()
            ->when($search, function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->withCount('transactions')
            ->latest('created_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return $this->staffView('staff.employees.index', compact('employees', 'search'));
    }

    public function create(): View
    {
        return $this->staffView('staff.employees.create');
    }

    public function store(KaryawanRequest $request): RedirectResponse
    {
        Karyawan::create($request->safe()->only([
            'nama_lengkap',
            'username',
            'email',
            'no_hp',
            'posisi_jabatan',
            'password',
        ]) + ['role' => Karyawan::ROLE_KARYAWAN]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Akun karyawan berhasil dibuat.');
    }

    public function show(Karyawan $karyawan): View
    {
        return $this->staffView('staff.employees.show', [
            'employee' => $karyawan->loadCount('transactions')->load(['transactions.user', 'transactions.layanan']),
        ]);
    }

    public function edit(Karyawan $karyawan): View
    {
        return $this->staffView('staff.employees.edit', compact('karyawan'));
    }

    public function update(KaryawanRequest $request, Karyawan $karyawan): RedirectResponse
    {
        $data = $request->safe()->only(['nama_lengkap', 'username', 'email', 'no_hp', 'posisi_jabatan']);
        if ($request->filled('password')) {
            $data['password'] = $request->string('password')->toString();
        }
        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan): RedirectResponse
    {
        if ($karyawan->transactions()->exists()) {
            return back()->with('error', 'Karyawan tidak dapat dihapus karena memiliki transaksi.');
        }

        $karyawan->delete();

        return back()->with('success', 'Karyawan berhasil dihapus.');
    }
}

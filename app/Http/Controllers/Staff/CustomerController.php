<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CustomerRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends StaffController
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $customers = User::query()
            ->when($search, function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->withCount('transactions')
            ->latest('created_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return $this->staffView('staff.customers.index', compact('customers', 'search'));
    }

    public function create(): View
    {
        return $this->staffView('staff.customers.create');
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        User::create($request->safe()->only([
            'nama_lengkap',
            'username',
            'email',
            'no_hp',
            'alamat',
            'password',
        ]) + ['role' => User::ROLE_PELANGGAN]);

        return redirect()->route($this->role().'.customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function show(User $user): View
    {
        return $this->staffView('staff.customers.show', [
            'customer' => $user->loadCount('transactions')->load(['transactions.layanan' => fn ($query) => $query->latest()->limit(10)]),
        ]);
    }

    public function edit(User $user): View
    {
        return $this->staffView('staff.customers.edit', compact('user'));
    }

    public function update(CustomerRequest $request, User $user): RedirectResponse
    {
        $data = $request->safe()->only([
            'nama_lengkap',
            'username',
            'email',
            'no_hp',
            'alamat',
        ]);

        if ($request->filled('password')) {
            $data['password'] = $request->string('password')->toString();
        }

        $user->update($data);

        return redirect()->route($this->role().'.customers.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->transactions()->exists()) {
            return back()->with('error', 'Pelanggan tidak dapat dihapus karena memiliki transaksi.');
        }

        $user->delete();

        return back()->with('success', 'Pelanggan berhasil dihapus.');
    }
}

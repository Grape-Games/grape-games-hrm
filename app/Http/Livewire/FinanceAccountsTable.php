<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class FinanceAccountsTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh', 'deleteAdminFinanceAccount'];

    public function deleteAdminFinanceAccount(User $user)
    {
        $user->delete()
            ? $this->emit('toast', 'success', "Account was deleted successfully.", "Account Status")
            : $this->emit('toast', 'error', "Failed to remove account.", "Account Status");
    }

    public function unassign($companyId)
    {
        Company::whereId($companyId)->update([
            'ceo_id' => null
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Role", "role")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Action")
        ];
    }

    public function query(): Builder
    {
        return User::query()->AdminAccounts();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.finance_accounts_table';
    }
}

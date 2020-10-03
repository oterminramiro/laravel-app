<?php

namespace App\Tables;

use App\Models\User;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTable
{
	protected function table(): Table
	{
		return (new Table)->model(User::class)
			->query(function (Builder $query) {
				$query->where('idrole', 2);
			})
			->routes([
				'index'   => ['name' => 'managers.index'],
				'create'  => ['name' => 'managers.create'],
				'edit'    => ['name' => 'managers.edit'],
				'destroy' => ['name' => 'managers.destroy'],
			])
			->rowsNumber(50)
			->activateRowsNumberDefinition(false)
			->destroyConfirmationHtmlAttributes(fn(User $user) => [
				'data-confirm' => __('Are you sure you want to delete the line ' . $user->database_attribute . ' ?'),
			]);
	}

	protected function columns(Table $table): void
	{
		$table->column('id')->title('Id')->sortable(true);
		$table->column('name')->title('Name')->sortable()->searchable();
		$table->column('email')->title('Email')->sortable()->searchable();
		$table->column('created_at')->title('Created')->dateTimeFormat('d/m/Y H:i')->sortable();
		$table->column('updated_at')->title('Updated')->dateTimeFormat('d/m/Y H:i')->sortable();
	}

	protected function resultLines(Table $table): void
	{
		//
	}
}

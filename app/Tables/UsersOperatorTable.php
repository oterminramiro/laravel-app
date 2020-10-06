<?php

namespace App\Tables;

use App\Models\User;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Table;

class UsersOperatorTable extends AbstractTable
{
	protected function table(): Table
	{
		return (new Table)->model(User::class)
			->query(function (Builder $query) {
				$query->where('idrole', 3);
			})
			->routes([
				'index'   => ['name' => 'operators.index'],
				'create'  => ['name' => 'operators.create'],
				'edit'    => ['name' => 'operators.edit'],
				'destroy' => ['name' => 'operators.destroy'],
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
		$table->column('guid')
		->title('Login as')
		#->prependHtml('<i class="fas fa-envelope"></i>')
		->link(function(User $user) {
			return route('login_as', $user->guid);
		})
		->value(function(User $user) {
			return 'Login';
		});
	}

	protected function resultLines(Table $table): void
	{
		//
	}
}

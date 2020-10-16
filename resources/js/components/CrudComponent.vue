<template>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Guid</td>
				<td>Created</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<tr v-for="value in organization">

				<td>{{ value.id }}</td>
				<td>{{ value.name }}</td>
				<td>{{ value.guid }}</td>
				<td>{{ value.created_at }}</td>
				<td>
					<a class="btn btn-small btn-success" href="#">Show</a>

					<a class="btn btn-small btn-info" href="#">Edit</a>

					<form class="d-inline" action="/manage/organizations/id/" method="post">

						<input type="submit" value="Delete" class="btn btn-small btn-danger">
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['organization'],
		data() {
	        return {
	        }
	    },
		mounted() {
			console.log('mounted');
		},

	}
</script>

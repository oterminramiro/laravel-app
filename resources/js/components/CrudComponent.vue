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
					<a class="btn btn-small btn-success" :href="'/manage/organizations/' + value.id">Show</a>
					<a class="btn btn-small btn-info" :href="'/manage/organizations/'+ value.id +'/edit'">Edit</a>

					<form class="d-inline" :action="'/manage/organizations/' + value.id +'/'" method="post">
						<input type="hidden" name="_token" :value="csrf">
						<input type="hidden" name="_method" value="DELETE">
						<input type="submit" value="Delete" class="btn btn-small btn-danger">
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['organization','csrf'],
		data() {
			return {
			}
		},
		mounted() {
			console.log(this.csrf);
		},
	}
</script>

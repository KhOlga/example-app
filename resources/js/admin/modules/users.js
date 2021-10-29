export default class Users {
	constructor() {
		Users.baseUrl =  window.baseUrl + '/admin/users';
		Users.selectors = {
			table: '#users-table',
		}

		Users.dataTableInit();
	}

	static dataTableInit() {

		let $dataTable = $(Users.selectors.table);
		if ($dataTable.length) {
			let url = $dataTable.data('url');
			window.datatable = Users.dataTable = $dataTable.DataTable({
				dom: '<"wrapper"flipt><"bottom"ip>',
				processing: true,
				serverSide: true,
				pagingType: "numbers",
				pageLength: 100,
				ajax: {
					url: url || Users.baseUrl + '/data',
				},
				columns: [
					{ data: 'id' },
					{ data: 'first_name', name: 'first_name' },
					{ data: 'last_name', name: 'last_name' },
					{ data: 'nickname', name: 'nickname' },
					{ data: 'email', name: 'email' },
					{ data: 'roles', sortable: false, searchable: false },
					{ data: 'teams', sortable: false, searchable: false },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'updated_at', name: 'updated_at' },
				]
			});
		}
	}
}
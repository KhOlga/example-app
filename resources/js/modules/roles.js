export default class Roles {
	constructor() {
		this.url = window.location.host + '/admin/roles';
		this.selectors = {
			table: '#roles-table',
		}

		this.dataTableInit();
	}

	static dataTableInit() {
		alert(window.location.host);
	}
}



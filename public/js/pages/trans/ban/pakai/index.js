$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
	return {
		iStart: oSettings._iDisplayStart,
		iEnd: oSettings.fnDisplayEnd(),
		iLength: oSettings._iDisplayLength,
		iTotal: oSettings.fnRecordsTotal(),
		iFilteredTotal: oSettings.fnRecordsDisplay(),
		iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		iTotalPages: Math.ceil(
			oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
		),
	};
};

$("#pakaiBanTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	language: {
		searchPlaceholder: "Search Kd Pakai/Truck",
	},
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#pakaiBanTables_filter input")
			.off(".DT")
			.on("input.DT", function () {
				api.search(this.value).draw();
			});
	},
	lengthChange: false,
	autoWidth: false,
	processing: true,
	serverSide: true,
	ajax: {
		url: "http://localhost/he-bengkel/pakai_ban/getPakai",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_pakai_ban",
			searchable: false,
			className: "text-center align-middle",
		},
		{
			data: "kd_pakai_ban",
			searchable: true,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "plat_no_truck",
			searchable: true,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data === null
					? '<i class="fas fa-minus fa-sm"></i>'
					: data.toUpperCase();
			},
		},
		{
			data: "nama_montir_ban",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "total_pakai_ban",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "tgl_pakai_ban",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				var date = new Date(data);
				return date.toLocaleDateString("id-ID", {
					day: "2-digit",
					month: "2-digit",
					year: "numeric",
				});
			},
		},
		{
			data: "view",
			className: "text-center align-middle",
		},
	],

	rowCallback: function (row, data, iDisplayIndex) {
		var info = this.fnPagingInfo();
		var page = info.iPage;
		var length = info.iLength;
		var index = page * length + (iDisplayIndex + 1);
		$("td:eq(0)", row).html(index + ".");
	},
});

$("#pakaiBanTables").on("click", ".btn-delete", function () {
	const kd = $(this).data("kd");

	Swal.fire({
		title: "Anda yakin ?",
		text: "Data akan di hapus !!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, Hapus !",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "http://localhost/he-bengkel/pakai_ban/delete",
				method: "POST",
				data: { kdpakai: kd },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dihapus!",
					});
					$("#pakaiBanTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

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

$("#percabTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#percabTables_filter input")
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
		url: "http://localhost/he-bengkel/percab/getPercab",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_percab",
			searchable: false,
			className: "text-center align-middle",
		},
		{
			data: "nosurat",
			searchable: true,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "tglsurat",
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
			data: "cabang",
			searchable: true,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "totalpercab",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "totalbyr",
			searchable: false,
			className: "align-middle",
			render: function (data, type, row) {
				var value = parseFloat(data);
				return (
					"Rp. " + value.toLocaleString("id-ID", { minimumFractionDigits: 0 })
				);
			},
		},
		{
			data: "percab_add",
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

$("#percabTables").on("click", ".btn-delete", function () {
	const no = $(this).data("no");
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
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/percab/delete",
				method: "POST",
				data: { no: no },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dihapus!",
					});

					$("#percabTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

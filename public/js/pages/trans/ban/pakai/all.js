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

$("#allPakaiBanTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	language: {
		searchPlaceholder: "Search Kd/Seri/Truck",
	},
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#allPakaiBanTables_filter input")
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
		url: "http://localhost/he-bengkel/pakai_ban/getDetailAll",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_detail_pakai_ban",
			className: "text-center",
			searchable: false,
		},
		{
			data: "kd_pakai_ban",
			searchable: true,
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "truck",
			searchable: true,
			render: function (data, type, row) {
				return data === null
					? '<i class="fas fa-minus fa-sm"></i>'
					: data.toUpperCase();
			},
		},
		{
			data: "no_seri",
			searchable: true,
			render: function (data, type, row) {
				if (data == null && row.nama_merk == null && row.ukuran_ban == null) {
					return "-";
				} else if (row.nama_merk == null) {
					return data.toUpperCase() + ", - ," + row.ukuran_ban;
				} else if (row.ukuran_ban == null) {
					return data.toUpperCase() + ", " + row.nama_merk + ", -";
				} else {
					return (
						data.toUpperCase() +
						", " +
						row.nama_merk.toUpperCase() +
						", " +
						row.ukuran_ban
					);
				}
			},
		},
		{
			data: "jml_pakai_ban",
			searchable: false,
			className: "text-center",
			render: function (data, type, row) {
				return data.toUpperCase() + " " + row.status_ban_pakai;
			},
		},
		{
			data: "status_pakai_ban",
			searchable: false,
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "ket_pakai_ban",
			searchable: false,
			render: function (data, type, row) {
				if (data == "") {
					return '<i class="fas fa-minus"></i>';
				} else {
					return data.toUpperCase();
				}
			},
		},
		{
			data: "tgl_pakai_ban",
			searchable: false,
			className: "text-center",
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
			className: "text-center",
			render: function (data, type, row) {
				if (row.jml_pakai_ban == "0") {
					return '<button type="button" class="btn btn-sm btn-secondary" disabled><i class="fas fa-ban fa-sm"></i></button>';
				} else {
					return (
						'<a href="http://localhost/he-bengkel/pakai_ban/kembaliGudang/' +
						row.id_detail_pakai_ban +
						'" class="btn btn-danger btn-sm kembali-gudang" data-toggle="tooltip" title="Kembalikan ke Gudang"><i class="fas fa-angle-double-right fa-sm"></i></a>'
					);
				}
			},
		},
	],

	fnDrawCallback: function (oSettings) {
		$('[data-toggle="tooltip"]').tooltip();
	},

	rowCallback: function (row, data, iDisplayIndex) {
		var info = this.fnPagingInfo();
		var page = info.iPage;
		var length = info.iLength;
		var index = page * length + (iDisplayIndex + 1);
		$("td:eq(0)", row).html(index + ".");
	},
});

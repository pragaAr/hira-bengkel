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

$("#detailAllTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#detailAllTables_filter input")
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
		url: "http://localhost/he-bengkel/vulkanisir/getAllDetail",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_detail_vulk",
			className: "text-center align-middle",
		},
		{
			data: "nama_toko",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "no_nota",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data === ""
					? '<span><i class="fas fa-minus fa-sm"></i></span>'
					: data.toUpperCase();
			},
		},
		{
			data: "no_seri_vulk",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return (
					data.toUpperCase() + ", " + row.merk_vulk + "," + row.ukuran_ban_vulk
				);
			},
		},
		{
			data: "jml_vulk",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "status",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data === "0"
					? '<span class="text-danger font-weight-bold">Proses</span>'
					: '<p class="font-weight-bold text-success">Selesai</p>';
			},
		},
		{
			data: "tgl_vulk",
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
			data: "tgl_update",
			className: "text-center align-middle",
			render: function (data, type, row) {
				var date = new Date(data);
				return data === "0000-00-00 00:00:00"
					? '<span><i class="fas fa-minus fa-sm"></i></span>'
					: date.toLocaleDateString("id-ID", {
							day: "2-digit",
							month: "2-digit",
							year: "numeric",
					  });
			},
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

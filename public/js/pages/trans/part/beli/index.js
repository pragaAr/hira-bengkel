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

$("#belipartTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	language: {
		searchPlaceholder: "Search DO",
	},
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#belipartTables_filter input")
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
		url: "http://localhost/he-bengkel/beli/getBeli",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_beli",
			searchable: false,
			className: "text-center align-middle",
		},
		{
			data: "kd_beli",
			searchable: true,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "no_nota",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (data === "") {
					return '<i class="fas fa-minus"></i>';
				} else {
					return data.toUpperCase();
				}
			},
		},
		{
			data: "nama_toko",
			searchable: true,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if ((data === null) | (data === "")) {
					return '<i class="fas fa-minus"></i>';
				} else {
					return data.toUpperCase();
				}
			},
		},
		{
			data: "total_beli",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "ppn",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (data == 0) {
					return data;
				} else if (data == "") {
					return '<i class="fas fa-minus"></i>';
				} else if (data >= 999) {
					var value = parseFloat(data);
					return (
						"Rp. " + value.toLocaleString("id-ID", { minimumFractionDigits: 0 })
					);
				}
			},
		},
		{
			data: "total_harga",
			searchable: false,
			className: "text-right align-middle",
			render: function (data, type, row) {
				var value = parseFloat(data);
				return (
					"Rp. " + value.toLocaleString("id-ID", { minimumFractionDigits: 0 })
				);
			},
		},
		{
			data: "status_bayar",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (data == "Lunas") {
					return '<button type="button" class="btn btn-info btn-sm border border-light" style="cursor:default;" title="Lunas"> <i class="fas fa-check-circle fa-sm"></button>';
				} else {
					return (
						'<a href="javascript:void(0);" class="btn btn-warning btn-sm border border-light btn-pelunasan" title="Pelunasan" data-kd="' +
						row.kd_beli +
						'"><i class="fas fa-money-bill fa-sm"></i></a>'
					);
				}
			},
		},
		{
			data: "retur",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (data == 1) {
					return '<a href="http://localhost/he-bengkel/retur" class="btn btn-danger btn-sm border border-light rounded-circle" title="Ada Retur"><i class="fas fa-exclamation-circle fa-sm"></i></a>';
				} else {
					return '<button type="button" class="btn btn-secondary btn-sm border border-light" title="Tidak ada Retur" style="cursor:default;"><i class="fas fa-minus-circle fa-sm"></i></button>';
				}
			},
		},
		{
			data: "tgl_beli",
			searchable: true,
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

$("#belipartTables").on("click", ".btn-pelunasan", function () {
	const kd = $(this).data("kd");

	Swal.fire({
		title: "Anda yakin ?",
		text: "Data akan dilunasi !!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, Lunasi !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/beli/pelunasan",
				method: "POST",
				data: { kd: kd },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dilunasi!",
					});
					$("#belipartTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

$("#belipartTables").on("click", ".btn-delete", function () {
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
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/beli/delete",
				method: "POST",
				data: { kdbeli: kd },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dihapus!",
					});
					$("#belipartTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

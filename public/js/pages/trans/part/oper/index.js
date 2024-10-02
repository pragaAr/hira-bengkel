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

$("#operTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	language: {
		searchPlaceholder: "Search Kd Oper",
	},
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#operTables_filter input")
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
		url: "http://localhost/he-bengkel/oper/getOper",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_oper",
			searchable: false,
			className: "text-center align-middle",
		},
		{
			data: "kd_oper",
			searchable: true,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "kd_pakai",
			searchable: false,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "jenis_part",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (data == null && row.nama_merk == null) {
					return "-";
				} else if (row.nama_merk == null) {
					return data.toUpperCase() + ", -";
				} else if (data == null) {
					return ", " + row.nama_merk.toUpperCase();
				} else {
					return data.toUpperCase() + ", " + row.nama_merk.toUpperCase();
				}
			},
		},
		{
			data: "plat_asal",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase() + ", " + row.merk_asal.toUpperCase();
			},
		},
		{
			data: "plat_oper",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase() + ", " + row.merk_oper.toUpperCase();
			},
		},
		{
			data: "jml_oper",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				if (row.sat == null) {
					return data + " -";
				} else {
					return data + " " + row.sat;
				}
			},
		},
		{
			data: "montir",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "status_oper",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "tgl_oper",
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

$("#operTables").on("click", ".btn-kembali", function () {
	const kd = $(this).data("kd");

	Swal.fire({
		title: "Anda yakin ?",
		text: "Data akan dikembalikan !!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, Kembalikan !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/oper/pengembalian",
				method: "POST",
				data: { kd: kd },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Sparepart diKembalikan!",
					});

					$("#operTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

$("#operanModal").on("shown.bs.modal", function () {
	$(".selecttruck")
		.select2({
			placeholder: "Pilih Truck",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/truck/getListTruck",
				dataType: "JSON",
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
					};
				},
				processResults: function (data) {
					return {
						results: data,
					};
				},
				cache: true,
			},
		})
		.on("select2:select", function (e) {
			const data = e.params.data;
			$("#tujuan").val(data.text);
		});
});

$("#operTables").on("click", ".btn-operan", function () {
	const kd = $(this).data("kd");

	$.ajax({
		url: "http://localhost/he-bengkel/oper/getDetailOperAgain",
		type: "POST",
		data: {
			kd: kd,
		},
		success: function (data) {
			const parsedata = JSON.parse(data);

			$("#subtitle").html(
				"Oper part dari Truck " + parsedata.asal.toUpperCase()
			);

			$("#detailpakai_id").val(kd);
			$("#kdpakai").val(parsedata.kd_oper);
			$("#jml").val(parsedata.jml_oper);
			$("#asalid").val(parsedata.asalid);
			$("#asal").val(parsedata.asal);
			$("#part").val(parsedata.part);
			$("#partid").val(parsedata.id_part);
			$("#sat").val(parsedata.sat);
			$("#merk").val(parsedata.merk);
			$("#merkid").val(parsedata.id_merk);

			$("#jmloper").attr({
				min: 1,
				max: parsedata.jml_pakai,
			});

			$("#operanModal").modal("show");
		},
	});
});

$("#jmloper").on("input", function () {
	if ($("#jmloper").val() > $("#jml").val()) {
		alert("Jumlah maksimal = " + $("#jml").val());
		$("#jmloper").val("");
	}
});

$("#form_operLagi").on("submit", function () {
	const detailid = $("#detailpakai_id").val();
	const kdpakai = $("#kdpakai").val();
	const jml = $("#jml").val();
	const asalid = $("#asalid").val();
	const asal = $("#asal").val();
	const tujuanid = $("#tujuanid").val();
	const tujuan = $("#tujuan").val();
	const part = $("#part").val();
	const partid = $("#partid").val();
	const sat = $("#sat").val();
	const merk = $("#merk").val();
	const merkid = $("#merkid").val();
	const jmloper = $("#jmloper").val();
	const montir = $("#montir").val();
	const ket = $("#ket").val();

	$.ajax({
		type: "POST",
		url: "http://localhost/he-bengkel/oper/operLagi",
		data: {
			detailid: detailid,
			kdpakai: kdpakai,
			jml: jml,
			asalid: asalid,
			asal: asal,
			tujuanid: tujuanid,
			tujuan: tujuan,
			part: part,
			partid: partid,
			sat: sat,
			merk: merk,
			merkid: merkid,
			jmloper: jmloper,
			montir: montir,
			ket: ket,
		},
		success: function (data) {
			console.log(data);
			$("#detailpakai_id").val("");
			$("#kdpakai").val("");
			$("#jml").val("");
			$("#asalid").val("");
			$("#asal").val("");
			$("#tujuanid").val(null).trigger("change");
			$("#tujuan").val("");
			$("#part").val("");
			$("#partid").val("");
			$("#sat").val("");
			$("#merk").val("");
			$("#merkid").val("");
			$("#jmloper").val("");
			$("#montir").val("");
			$("#ket").val("");

			$("#operanModal").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Sparepart dioper lagi!",
			});
			$("#operTables").DataTable().ajax.reload(null, false);
		},
	});

	return false;
});

$(document).on("select2:open", () => {
	document
		.querySelector(".select2-container--open .select2-search__field")
		.focus();
});

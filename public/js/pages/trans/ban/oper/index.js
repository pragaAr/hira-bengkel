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

$("#operBanTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	language: {
		searchPlaceholder: "Search Kd Oper",
	},
	initComplete: function () {
		var api = this.api();
		$("#operBanTables_filter input")
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
		url: "http://localhost/he-bengkel/oper_ban/getOper",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_oper_ban",
			searchable: false,
			className: "text-center align-middle",
		},
		{
			data: "kd_oper_ban",
			searchable: true,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "kd_pakai_ban",
			searchable: false,
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "no_seri",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data === null && row.nama_merk === null
					? "-"
					: row.nama_merk === null
					? data.toUpperCase() + ", -"
					: data === null
					? ", " + row.nama_merk.toUpperCase()
					: data.toUpperCase() + ", " + row.nama_merk.toUpperCase();
			},
		},
		{
			data: "truckasal",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase() + ", " + row.merkasal.toUpperCase();
			},
		},
		{
			data: "trucktujuan",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase() + ", " + row.merktujuan.toUpperCase();
			},
		},
		{
			data: "jml_ban_oper",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
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
			data: "status_oper_ban",
			searchable: false,
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
			},
		},
		{
			data: "tgl_oper_ban",
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

$("#operBanTables").on("click", ".btn-kembali", function () {
	const kd = $(this).data("kd");
	console.log(kd);

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
				url: "http://localhost/he-bengkel/oper_ban/pengembalian",
				method: "POST",
				data: { kd: kd },
				success: function (data) {
					console.log(JSON.parse(data));

					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Sparepart Berhasil Di Kembalikan!",
					});

					$("#operBanTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

$("#operLagiModal").on("shown.bs.modal", function () {
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

$("#operBanTables").on("click", ".btn-operan", function () {
	const kd = $(this).data("kd");

	$.ajax({
		url: "http://localhost/he-bengkel/oper_ban/getDetailOperAgain",
		type: "POST",
		data: {
			kd: kd,
		},
		success: function (data) {
			const parsedata = JSON.parse(data);
			console.log(parsedata);

			$("#subtitle").html("Oper ban dari " + parsedata.tujuan.toUpperCase());

			$("#kdoper").val(parsedata.kd_oper_ban);
			$("#dari").val(parsedata.asalid);
			$("#daritruck").val(parsedata.tujuan);
			$("#jmlban").val(parsedata.jml_ban_oper);
			$("#seri").val(parsedata.no_seri);
			$("#banid").val(parsedata.id_ban);
			$("#merk").val(parsedata.merk);
			$("#merkid").val(parsedata.merk_ban_id);
			$("#pakaiid").val(parsedata.detail_pakai_ban_id);

			$("#operLagiModal").modal("show");
		},
	});
});

$("#form_operLagi").on("submit", function () {
	const detailid = $("#pakaiid").val();
	const kdoper = $("#kdoper").val();
	const jmlban = $("#jmlban").val();
	const dari = $("#dari").val();
	const daritruck = $("#daritruck").val();
	const seri = $("#seri").val();
	const banid = $("#banid").val();
	const merk = $("#merk").val();
	const merkid = $("#merkid").val();
	const tujuanid = $("#tujuanid").val();
	const tujuan = $("#tujuan").val();
	const montir = $("#montir").val();
	const ket = $("#ket").val();

	$.ajax({
		type: "POST",
		url: "http://localhost/he-bengkel/oper_ban/operLagi",
		data: {
			detailid: detailid,
			kdoper: kdoper,
			jmlban: jmlban,
			dari: dari,
			daritruck: daritruck,
			seri: seri,
			tujuanid: tujuanid,
			tujuan: tujuan,
			banid: banid,
			merk: merk,
			merkid: merkid,
			montir: montir,
			ket: ket,
		},
		success: function (data) {
			console.log(data);
			$("#seri").val("");
			$("#dari").val("");
			$("#kdoper").val("");
			$("#banid").val("");
			$("#pakaiid").val("");
			$("#tujuanid").val(null).trigger("change");
			$("#tujuan").val("");
			$("#merk").val("");
			$("#merkid").val("");
			$("#jmlban").val("");
			$("#montir").val("");
			$("#ket").val("");

			$("#operLagiModal").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Ban berhasil di oper lagi!",
			});

			$("#operBanTables").DataTable().ajax.reload(null, false);
		},
	});

	return false;
});

$("#operBanTables").on("click", ".btn-kembali-gudang", function () {
	const id = $(this).data("id");

	Swal.fire({
		title: "Anda yakin ?",
		text: "Ban akan dikembalikan !!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, kembalikan !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/oper_ban/kembaliGudang",
				type: "POST",
				data: {
					id: id,
				},
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Ban berhasil dikembalikan ke gudang!",
					});

					$("#operBanTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

$(document).on("select2:open", () => {
	document
		.querySelector(".select2-container--open .select2-search__field")
		.focus();
});

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

$("#truckTables").DataTable({
	ordering: false,
	initComplete: function () {
		var api = this.api();
		$("#truckTables_filter input")
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
		url: "http://localhost/he-bengkel/truck/getTruck",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_truck",
			className: "text-center align-middle",
		},
		{
			data: "plat_no_truck",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "merk_truck",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "jenis_truck",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
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

$("#btn-add-truck").on("click", function () {
	$("#addTruck").modal("show");
});

$("#addTruck").on("shown.bs.modal", function () {
	$('input[name="platno"]').focus();
});

$("#form_addTruck").on("submit", function () {
	const platno = $("#platno").val();
	const merk = $("#merk").val();
	const jenis = $("#jenis").val();

	$.ajax({
		url: "http://localhost/he-bengkel/truck/create",
		type: "POST",
		data: {
			platno: platno,
			merk: merk,
			jenis: jenis,
		},
		success: function (data) {
			$("#platno").val("");
			$("#merk").val("");
			$("#jenis").val("");
			$("#addTruck").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Data berhasil ditambah!",
			});
			$("#truckTables").DataTable().ajax.reload(null, false);
		},
	});
	return false;
});

$("#editTruck").on("shown.bs.modal", function () {
	$('input[name="platnoedit"]').focus();
});

$("#truckTables").on("click", ".btn-edit-truck", function (e) {
	const id = $(this).data("id");

	$.ajax({
		url: "http://localhost/he-bengkel/truck/getId",
		type: "POST",
		data: {
			idtruck: id,
		},
		success: function (data) {
			const parsedata = JSON.parse(data);

			$("#idtruck").val(parsedata.id_truck);
			$("#platnoedit").val(parsedata.plat_no_truck);
			$("#merkedit").val(parsedata.merk_truck);
			$("#jenisedit").val(parsedata.jenis_truck);

			$("#editTruck").modal("show");
		},
	});
});

$("#form_editTruck").on("submit", function () {
	const id = $("#idtruck").val();
	const platnoedit = $("#platnoedit").val();
	const merkedit = $("#merkedit").val();
	const jenisedit = $("#jenisedit").val();

	$.ajax({
		type: "POST",
		url: "http://localhost/he-bengkel/truck/update",
		data: {
			id: id,
			platno: platnoedit,
			merk: merkedit,
			jenis: jenisedit,
		},
		success: function (data) {
			$("#idtruck").val("");
			$("#platnoedit").val("");
			$("#merkedit").val("");
			$("#jenisedit").val("");
			$("#editTruck").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Data Truck berhasil diubah!",
			});
			$("#truckTables").DataTable().ajax.reload(null, false);
		},
	});
	return false;
});

$("#truckTables").on("click", ".btn-delete-truck", function () {
	const id = $(this).data("id");
	Swal.fire({
		title: "Anda yakin ?",
		text: "Data akan dihapus !!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, Hapus !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/truck/delete",
				method: "POST",
				data: { idtruck: id },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dihapus!",
					});
					$("#truckTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

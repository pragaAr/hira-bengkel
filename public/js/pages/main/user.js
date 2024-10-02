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

$("#userTables").DataTable({
	ordering: false,
	initComplete: function () {
		var api = this.api();
		$("#userTables_filter input")
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
		url: "http://localhost/he-bengkel/user/getUsers",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_user",
			className: "text-center align-middle",
		},
		{
			data: "nama_user",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "username",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toLowerCase();
			},
		},
		{
			data: "no_telp_user",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "user_role",
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

$("#btn-add-user").on("click", function () {
	$("#addUser").modal("show");
});

$("#addUser").on("shown.bs.modal", function () {
	$('input[name="nama"]').focus();

	$("#username").on("input", function () {
		const newuname = $(this).val();

		$.ajax({
			url: "http://localhost/he-bengkel/user/cekusername",
			type: "POST",
			dataType: "json",
			data: {
				username: newuname,
			},
			success: function (data) {
				if (data.length > 0) {
					setTimeout(() => {
						$(".output").css("display", "block");
						$(".output")
							.html(
								"<small class='text-danger'>#Username sudah digunakan!</small > "
							)
							.fadeIn("slow");

						$("#add-user").prop("disabled", true);
					}, 250);
				} else {
					setTimeout(() => {
						$(".output").css("display", "none");

						$("#add-user").prop("disabled", false);
					}, 250);
				}
			},
		});
	});

	$(".selectrole").select2({
		theme: "bootstrap4",
	});
});

$("#form_addUser").on("submit", function () {
	const nama = $("#nama").val();
	const telpon = $("#telpon").val();
	const username = $("#username").val();
	const pass = $("#pass").val();
	const role = $("#role").val();

	$.ajax({
		url: "http://localhost/he-bengkel/user/create",
		type: "POST",
		data: {
			nama: nama,
			telpon: telpon,
			username: username,
			pass: pass,
			role: role,
		},
		success: function (data) {
			$("#nama").val("");
			$("#telpon").val("");
			$("#username").val("");
			$("#pass").val("");
			$("#role").val("");
			$("#addUser").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Data User berhasil ditambah!",
			});
			$("#userTables").DataTable().ajax.reload(null, false);
		},
	});
	return false;
});

$("#editUser").on("shown.bs.modal", function () {
	$('input[name="namaedit"]').focus();

	$("#usernameupdate").on("input", function () {
		const newuname = $(this).val();
		const olduname = $("#usernameold").val();

		if (newuname !== olduname) {
			$.ajax({
				url: "http://localhost/he-bengkel/user/cekusername",
				type: "POST",
				dataType: "json",
				data: {
					username: newuname,
				},
				success: function (data) {
					if (data.length > 0) {
						setTimeout(() => {
							$(".output")
								.show()
								.html(
									"<span class='text-danger'><em> Username sudah digunakan!</em ></span > "
								)
								.fadeIn("slow");

							$("#btn-update-user").prop("disabled", true);
						}, 250);
					} else {
						setTimeout(() => {
							$(".output").hide();

							$("#edit-user").prop("disabled", false);
						}, 250);
					}
				},
			});
		}
	});

	$(".roleupdate").select2({
		theme: "bootstrap4",
	});
});

$("#userTables").on("click", ".btn-edit-user", function (e) {
	const id = $(this).data("id");

	$.ajax({
		url: "http://localhost/he-bengkel/user/getId",
		type: "POST",
		data: {
			iduser: id,
		},
		success: function (data) {
			const parsedata = JSON.parse(data);

			$("#iduser").val(parsedata.id_user);
			$("#namaedit").val(parsedata.nama_user);
			$("#telpedit").val(parsedata.no_telp_user);
			$("#usernameold").val(parsedata.username);
			$("#usernameupdate").val(parsedata.username);
			$("#roleupdate").val(parsedata.user_role).trigger("change");

			$("#editUser").modal("show");
		},
	});
});

$("#form_editUser").on("submit", function () {
	const id = $("#iduser").val();
	const nama = $("#namaedit").val();
	const telp = $("#telpedit").val();
	const username = $("#usernameupdate").val();
	const pass = $("#passupdate").val();
	const role = $("#roleupdate").val();

	$.ajax({
		url: "http://localhost/he-bengkel/user/update",
		type: "POST",
		data: {
			id: id,
			nama: nama,
			telp: telp,
			username: username,
			pass: pass,
			role: role,
		},
		success: function (data) {
			$("#iduser").val("");
			$("#namaedit").val("");
			$("#telpedit").val("");
			$("#usernameupdate").val("");
			$("#passupdate").val("");
			$("#roleupdate").val(null).trigger("change");
			$("#editUser").modal("hide");

			Swal.fire({
				icon: "success",
				title: "Success!",
				text: "Data User berhasil diubah!",
			});
			$("#userTables").DataTable().ajax.reload(null, false);
		},
	});
	return false;
});

$("#userTables").on("click", ".btn-delete-user", function () {
	const id = $(this).data("id");
	Swal.fire({
		title: "Anda yakin ?",
		text: "Data akan dihapus !",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
		confirmButtonText: "Ya, Hapus !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/he-bengkel/user/delete",
				method: "POST",
				data: { iduser: id },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data User dihapus!",
					});
					$("#userTables").DataTable().ajax.reload(null, false);
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

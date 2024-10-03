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

$("#vulkBanTables").DataTable({
	ordering: true,
	order: [[0, "desc"]],
	pageLength: 10,
	initComplete: function () {
		var api = this.api();
		$("#vulkBanTables_filter input")
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
		url: "http://localhost/he-bengkel/vulkanisir/getVulkanisir",
		type: "POST",
		dataType: "json",
	},
	columns: [
		{
			data: "id_vulk",
			className: "text-center align-middle",
		},
		{
			data: "kd_vulk",
			className: "align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "nama_toko",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data.toUpperCase();
			},
		},
		{
			data: "jml_total_vulk",
			className: "text-center align-middle",
			render: function (data, type, row) {
				return data;
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

$("#vulkBanTables").on("click", ".btn-detail", function () {
	const kd = $(this).data("kd");

	$.ajax({
		url: "http://localhost/he-bengkel/vulkanisir/detail",
		method: "POST",
		dataType: "JSON",
		data: { kd: kd },
		success: function (data) {
			console.log(data);
			const tbody = $("#tbodyDetail");

			$("#titledetail").html("Detail Vulkanisir " + data.kdvulk);

			$("#detailtempat").html("Di " + data.tempat);
			$("#detailtgl").html("Tgl " + data.tglvulk);

			tbody.empty();

			$.each(data.detail, function (index, item) {
				const statusText = item.status === "1" ? "Selesai" : "Proses";
				const row =
					"<tr>" +
					"<td>" +
					item.no_seri_vulk +
					"</td>" +
					"<td>" +
					item.merk_vulk +
					"</td>" +
					"<td>" +
					item.ukuran_ban_vulk +
					"</td>" +
					"<td>" +
					statusText +
					"</td>" +
					"</tr>";

				tbody.append(row);
			});

			$("#detailVulk").modal("show");
		},
	});
});

$("#vulkBanTables").on("click", ".btn-delete", function () {
	const kd = $(this).data("kd");
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
				url: "http://localhost/he-bengkel/vulkanisir/delete",
				method: "POST",
				data: { kd: kd },
				success: function (data) {
					Swal.fire({
						icon: "success",
						title: "Success!",
						text: "Data berhasil dihapus!",
					});
					$("#vulkBanTables").DataTable().ajax.reload(null, false);
				},
			});
		}
	});
});

$("#cetakDo").on("shown.bs.modal", function () {
	$(".selectnota")
		.select2({
			placeholder: "Pilih Nota",
			theme: "bootstrap4",
			ajax: {
				url: "http://localhost/he-bengkel/vulkanisir/getNota",
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
			$("#nota").val(data.text);
		});
});

$(document).on("select2:open", () => {
	document
		.querySelector(".select2-container--open .select2-search__field")
		.focus();
});

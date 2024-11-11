$(document).ready(function () {
	$(".editBtn").on("click", function () {
		const id = $(this).data("id");

		$.ajax({
			url: '<?= base_url("Laporan_penjualan/getubah"); ?>',
			method: "POST",
			data: { order_detail_id: id },
			dataType: "json",
			success: function (data) {
				console.log(data);
				$("#order_detail_id").val(data.order_detail_id);
				$("#produk").val(data.produk);
				$("#jumlah").val(data.jumlah);
				$("#harga").val(data.harga);
				$("#status").val(data.status);
			},
			error: function () {
				alert("Gagal mengambil data.");
			},
		});
	});
});

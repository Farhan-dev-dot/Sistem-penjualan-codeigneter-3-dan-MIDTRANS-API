document.addEventListener("DOMContentLoaded", function () {
	const pendapatanData = JSON.parse(
		document.getElementById("harianLabels").value
	);

	console.log(pendapatanData);

	const hariLabels = pendapatanData.map((item) => item.hari);
	const totalPendapatan = pendapatanData.map((item) =>
		parseFloat(item.total_pendapatan)
	);

	const ctxHarian = document
		.getElementById("pendapatanPerHari")
		.getContext("2d");

	const pendapatanBulan = JSON.parse(
		document.getElementById("bulananLabels").value
	);

	const ctxBulanan = document
		.getElementById("pendapatanPerBulan")
		.getContext("2d");
	const bulanLabels = pendapatanBulan.map((item) => item.bulan);

	const totalPendapatanBulanan = pendapatanBulan.map((item) =>
		parseFloat(item.total_pendapatan_bulan)
	);

	new Chart(ctxHarian, {
		type: "line",
		data: {
			labels: hariLabels,
			datasets: [
				{
					label: "Akumulasi Pendapatan Harian",
					data: totalPendapatan,
					backgroundColor: "rgba(139, 0, 0, 0.2)",
					borderColor: "rgba(139, 0, 0, 1)",
					borderWidth: 2,
					fill: true,
					pointRadius: 5,
					pointBackgroundColor: "rgba(139, 0, 0, 1)",
					pointBorderColor: "#fff",
					pointBorderWidth: 2,
					lineTension: 0.4,
				},
			],
		},
		options: {
			responsive: true,
			scales: {
				y: {
					beginAtZero: true,
					ticks: {
						callback: function (value) {
							return "Rp " + value.toLocaleString();
						},
					},
				},
			},
			plugins: {
				tooltip: {
					callbacks: {
						label: function (tooltipItem) {
							return "Rp " + tooltipItem.raw.toLocaleString();
						},
					},
				},
				legend: {
					display: true,
					position: "top",
				},
			},
		},
	});

	new Chart(ctxBulanan, {
		type: "bar",
		data: {
			labels: bulanLabels,
			datasets: [
				{
					label: "Akumulasi Pendapatan Bulanan",
					data: totalPendapatanBulanan,
					backgroundColor: "rgba(192, 192, 192, 0.2)",
					borderColor: "rgba(192, 192, 192, 1)",
					borderWidth: 2,
					fill: false,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
					ticks: {
						callback: function (value) {
							return "Rp " + value.toLocaleString();
						},
					},
				},
			},
			plugins: {
				tooltip: {
					callbacks: {
						label: function (tooltipItem) {
							return "Rp " + tooltipItem.raw.toLocaleString();
						},
					},
				},
			},
		},
	});
});

let inputMonth = document.getElementById('changeperiod');
let inputYear = document.getElementById('changeyear');
let partpriceTotal = document.getElementById('partpriceTotal');
let partItems = document.getElementById('partItems');
let partTunai = document.getElementById('partTunai');
let partTempo = document.getElementById('partTempo');
let banpriceTotal = document.getElementById('banPriceTotal');
let banItems = document.getElementById('banItems');
let banTunai = document.getElementById('banTunai');
let banTempo = document.getElementById('banTempo');
let percabPriceTotal = document.getElementById('percabPriceTotal');

async function fetchData() {
  const inputValue = inputMonth.value;

  try {
    const [
      belanjaPart,
      belanjaPartTunai,
      belanjaPartTempo,
      belanjaBan,
      belanjaBanTunai,
      belanjaBanTempo,
      percab,
    ] = await Promise.all([
      fetch(`http://localhost/he-bengkel/home/getBelanjaPart?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getPartTunai?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getPartTempo?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getBelanjaBan?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getBanTunai?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getBanTempo?month=${inputValue}`),
      fetch(`http://localhost/he-bengkel/home/getPercab?month=${inputValue}`),
    ]);

    const sumPartData = await belanjaPart.json();
    const sumPartTunai = await belanjaPartTunai.json();
    const sumPartTempo = await belanjaPartTempo.json();
    const sumBanData = await belanjaBan.json();
    const sumBanTunai = await belanjaBanTunai.json();
    const sumBanTempo = await belanjaBanTempo.json();
    const sumPercabData = await percab.json();

    partpriceTotal.textContent =
      sumPartData.total !== null ? 'Rp. ' + format(sumPartData.total) : 'Rp. 0';

    percabPriceTotal.textContent =
      sumPercabData.total !== null
        ? 'Rp. ' + format(sumPercabData.total)
        : 'Rp. 0';

    partItems.textContent =
      sumPartData.items !== null ? sumPartData.items + ' items' : '0 items';

    partTunai.textContent =
      sumPartTunai.total !== null
        ? 'Rp. ' + format(sumPartTunai.total)
        : 'Rp. 0';

    partTempo.textContent =
      sumPartTempo.total !== null
        ? 'Rp. ' + format(sumPartTempo.total)
        : 'Rp. 0';

    banpriceTotal.textContent =
      sumBanData.total !== null ? 'Rp. ' + format(sumBanData.total) : 'Rp. 0';

    banItems.textContent =
      sumBanData.items !== null ? sumBanData.items + ' items' : '0 items';

    banTunai.textContent =
      sumBanTunai.total !== null ? 'Rp. ' + format(sumBanTunai.total) : 'Rp. 0';

    banTempo.textContent =
      sumBanTempo.total !== null ? 'Rp. ' + format(sumBanTempo.total) : 'Rp. 0';
  } catch (error) {
    console.error('Error fetching data:', error);
    return [];
  }
}

fetchData();

inputMonth.addEventListener('change', function () {
  const selectedMonth = inputMonth.value;

  fetchUpdateData(selectedMonth);
});

async function fetchUpdateData(selectedMonth) {
  try {
    const [
      belanjaPartUpdate,
      belanjaPartTunaiUpdate,
      belanjaPartTempoUpdate,
      belanjaBanUpdate,
      belanjaBanTunaiUpdate,
      belanjaBanTempoUpdate,
      percabUpdate,
    ] = await Promise.all([
      fetch(`http://localhost/he-bengkel/home/getBelanjaPart?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getPartTunai?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getPartTempo?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getBelanjaBan?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getBanTunai?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getBanTempo?month=${selectedMonth}`),
      fetch(`http://localhost/he-bengkel/home/getPercab?month=${selectedMonth}`),
    ]);

    const updatePartData = await belanjaPartUpdate.json();
    const updatePartTunai = await belanjaPartTunaiUpdate.json();
    const updatePartTempo = await belanjaPartTempoUpdate.json();
    const updateBanData = await belanjaBanUpdate.json();
    const updateBanTunai = await belanjaBanTunaiUpdate.json();
    const updateBanTempo = await belanjaBanTempoUpdate.json();
    const updatePercabData = await percabUpdate.json();

    partpriceTotal.textContent =
      updatePartData.total !== null
        ? 'Rp. ' + format(updatePartData.total)
        : 'Rp. 0';

    percabPriceTotal.textContent =
      updatePercabData.total !== null
        ? 'Rp. ' + format(updatePercabData.total)
        : 'Rp. 0';

    partItems.textContent =
      updatePartData.items !== null
        ? updatePartData.items + ' items'
        : '0 items';

    partTunai.textContent =
      updatePartTunai.total !== null
        ? 'Rp. ' + format(updatePartTunai.total)
        : 'Rp. 0';

    partTempo.textContent =
      updatePartTempo.total !== null
        ? 'Rp. ' + format(updatePartTempo.total)
        : 'Rp. 0';

    banpriceTotal.textContent =
      updateBanData.total !== null
        ? 'Rp. ' + format(updateBanData.total)
        : 'Rp. 0';

    banItems.textContent =
      updateBanData.items !== null ? updateBanData.items + ' items' : '0 items';

    banTunai.textContent =
      updateBanTunai.total !== null
        ? 'Rp. ' + format(updateBanTunai.total)
        : 'Rp. 0';

    banTempo.textContent =
      updateBanTempo.total !== null
        ? 'Rp. ' + format(updateBanTempo.total)
        : 'Rp. 0';
  } catch (error) {
    console.error('Error fetching data:', error);
    return [];
  }
}

let salesChart;
const canvas = document.getElementById('partTahunan');

async function getDataYearly() {
  const inputYearValue = inputYear.value;

  try {
    const [partYearly, banYearly] = await Promise.all([
      fetch(
        `http://localhost/he-bengkel/home/getBelanjaPartTahunan?year=${inputYearValue}`
      ),
      fetch(
        `http://localhost/he-bengkel/home/getBelanjaBanTahunan?year=${inputYearValue}`
      ),
    ]);

    const dataPartTahunan = await partYearly.json();
    const chartPartTahunan = dataPartTahunan.map((entry) =>
      parseInt(entry.total)
    );

    const dataBanTahunan = await banYearly.json();
    const chartBanTahunan = dataBanTahunan.map((entry) =>
      parseInt(entry.total)
    );

    return { chartPartTahunan, chartBanTahunan };
  } catch (error) {
    console.error('Error fetching data:', error);
    return {};
  }
}

async function drawChart() {
  const { chartPartTahunan, chartBanTahunan } = await getDataYearly();

  salesChart = new Chart(canvas, {
    type: 'line',
    data: {
      labels: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
      ],
      datasets: [
        {
          label: 'Pembelian Part',
          data: chartPartTahunan,
          backgroundColor: 'rgba(255, 29, 0, 0.2)',
          borderColor: 'rgba(255, 29, 0, 0.8)',
          borderWidth: 2,
          fill: true,
        },
        {
          label: 'Pembelian Ban',
          data: chartBanTahunan,
          backgroundColor: 'rgba(0, 13, 255, 0.2)',
          borderColor: 'rgba(0, 13, 255, 0.8)',
          borderWidth: 2,
          fill: true,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            beginAtZero: true,
            ticks: {
              callback: function (value, index, values) {
                return `Rp. ${format(value)}`;
              },
            },
          },
        ],
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            const datasetIndex = tooltipItem.datasetIndex;
            let value = data.datasets[datasetIndex].data[tooltipItem.index]; // Mendapatkan nilai dari dataset yang sesuai
            let label = data.datasets[datasetIndex].label || '';
            return 'Pembelian ' + ': Rp ' + format(value);
          },
        },
        backgroundColor: 'black',
        borderColor: 'white',
      },
    },
  });
}

drawChart();

inputYear.addEventListener('change', function () {
  const selectedYear = inputYear.value;

  salesChart.destroy();

  fetchUpdateDataYearly(selectedYear);
});

async function fetchUpdateDataYearly(selectedYear) {
  try {
    const [partYearlyUpdate, banYearlyUpdate] = await Promise.all([
      fetch(
        `http://localhost/he-bengkel/home/getBelanjaPartTahunan?year=${selectedYear}`
      ),
      fetch(
        `http://localhost/he-bengkel/home/getBelanjaBanTahunan?year=${selectedYear}`
      ),
    ]);

    const dataPartTahunanUpdate = await partYearlyUpdate.json();
    const chartPartTahunanUpdate = dataPartTahunanUpdate.map((entry) =>
      parseInt(entry.total)
    );

    const dataBanTahunanUpate = await banYearlyUpdate.json();
    const chartBanTahunanUpdate = dataBanTahunanUpate.map((entry) =>
      parseInt(entry.total)
    );

    salesChart = new Chart(canvas, {
      type: 'line',
      data: {
        labels: [
          'Jan',
          'Feb',
          'Mar',
          'Apr',
          'May',
          'Jun',
          'Jul',
          'Aug',
          'Sep',
          'Oct',
          'Nov',
          'Dec',
        ],
        datasets: [
          {
            label: 'Pembelian Part',
            data: chartPartTahunanUpdate,
            backgroundColor: 'rgba(255, 29, 0, 0.2)',
            borderColor: 'rgba(255, 29, 0, 0.8)',
            borderWidth: 2,
            fill: true,
          },
          {
            label: 'Pembelian Ban',
            data: chartBanTahunanUpdate,
            backgroundColor: 'rgba(0, 13, 255, 0.2)',
            borderColor: 'rgba(0, 13, 255, 0.8)',
            borderWidth: 2,
            fill: true,
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              beginAtZero: true,
              ticks: {
                callback: function (value, index, values) {
                  return `Rp. ${format(value)}`;
                },
              },
            },
          ],
        },
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              const datasetIndex = tooltipItem.datasetIndex;
              let value = data.datasets[datasetIndex].data[tooltipItem.index]; // Mendapatkan nilai dari dataset yang sesuai
              let label = data.datasets[datasetIndex].label || '';
              return 'Pembelian ' + ': Rp ' + format(value);
            },
          },
          backgroundColor: 'black',
          borderColor: 'white',
        },
        plugins: {
          // Opsi transisi antara dataset yang berbeda
          transition: {
            // Konfigurasi animasi saat dataset berubah
            duration: 1000, // Durasi animasi dalam milisekon
            easing: 'easeInOutQuad', // Jenis easing yang digunakan
          },
        },
      },
    });
  } catch (error) {
    console.error('Error fetching data:', error);
    return {};
  }
}

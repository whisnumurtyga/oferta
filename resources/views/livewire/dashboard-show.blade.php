<div>
    <div>
        <h1 class="th-3 text-center mb-3" style="font-size: 32px">PROFIT TRANSAKSI</h1>
        {{ $test }}
        <div class="row">
            <div class="col-8">
                <canvas wire:ignore id="transactionLineChart" width="800" height="400"></canvas>
            </div>
            <div class="col-4">
                <div>
                    <h1 class="mt-4">Filter By Interval</h1>
                    <div class="form-check ">
                        <input  wire:change='filterTransactions' class="form-check-input" type="radio" name="all" id="all" value="all" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="all">
                            All
                        </label>
                     </div>
                    <div class="form-check">
                        <input wire:change='filterTransactions' class="form-check-input" type="radio" name="7days" id="7days" value="7days" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="7days">
                            7 Days Ago
                        </label>
                     </div>
                    <div class="form-check">
                        <input wire:change='filterTransactions' class="form-check-input" type="radio" name="1month" id="1month" value="1month" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="1month">
                            1 Month Ago
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:change='filterTransactions' class="form-check-input" type="radio" name="3months" id="3months" value="3months" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="3months">
                            3 Months Ago
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:change='filterTransactions' class="form-check-input" type="radio" name="1year" id="1year" value="1year" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="1year">
                            1 Year Ago
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:change='filterTransactions' class="form-check-input" type="radio" name="5years" id="5years" value="5years" wire:model='timerangeTransaction'>
                        <label class="form-check-label" for="5years">
                            5 Year Ago
                        </label>
                    </div>
                </div>
                <div class="">
                    <h1 class="mt-4">Custom Interval</h1>
                    <div class="col-8 mt-1">
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input  wire:model='startDate' wire:change='customFilterTransactions()' type="date" id="startDate" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input wire:model='endDate' wire:change='customFilterTransactions()'z1 id="endDate" type="date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4 d-flex flex-column align-items-center">
                <h1 class="text-center th-3 text-big">Proporsi Profit By Member Major</h1>
                <select wire:change="filterPieTransactionByMajor"  wire:model="filterProfitByMember"  id="myCustomSelect" class="form-select mt-3 mb-2" aria-label="Default select example">
                    <option value="all" selected>All</option>
                    <option value="7days">7 Days</option>
                    <option value="1month">1 Month Ago</option>
                    <option value="3months">3 Months Ago</option>
                    <option value="1year">1 Year Ago</option>
                    <option value="5years">5 Years Ago</option>
                </select>
                <canvas wire:ignore class="mt-2" id="memberDoughnutChart" width="400" height="400" style="width:400px"></canvas>
            </div>
            <div class="mt-5">
                <div class="mb-3">
                    <label for="startDatePieMajor" class="form-label">Start Date</label>
                    <input  wire:model='startDatePieMajor' wire:change='customFilterPieMajor()' type="date" id="startDate" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="endDatePieMajor" class="form-label">End Date</label>
                    <input wire:model='endDatePieMajor' wire:change='customFilterPieMajor()' id="endDate" type="date" class="form-control">
                </div>
            </div>
            <div class="col-4  d-flex flex-column align-items-center">
                <h1 class="text-center th-3 text-big">Proporsi Profit By Payment</h1>
                <select wire:change="filterPieTransactionByPayment"  wire:model="filterProfitByPayment"  id="myCustomSelect" class="form-select mt-3 mb-2" aria-label="Default select example">
                    <option value="all" selected>All</option>
                    <option value="7days">7 Days</option>
                    <option value="1month">1 Month Ago</option>
                    <option value="3months">3 Months Ago</option>
                    <option value="1year">1 Year Ago</option>
                    <option value="5years">5 Years Ago</option>
                </select>
                <canvas wire:ignore class="mt-2" id="paymentDoughnutChart" width="400" height="400" style="width:400px"></canvas>
            </div>
            <div class="mt-5">
                <div class="mb-3">
                    <label for="startDatePiePayment" class="form-label">Start Date</label>
                    <input  wire:model='startDatePiePayment' wire:change='customFilterPiePayment' type="date" id="startDate" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="endDatePiePayment" class="form-label">End Date</label>
                    <input wire:model='endDatePiePayment' wire:change='customFilterPiePayment' id="endDate" type="date" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>


{{-- TODO: INI JANGAN DIDELETE AJG --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>



<!-- Di sini Anda dapat menggunakan Blade directive untuk mendapatkan data transaksi -->
<script>
    var interval = @json($interval);
    var total = @json($total);

    // Fungsi untuk menggambar chart dengan data yang diberikan
    function drawTransactionLineChart(intervals, totals) {
        // Hancurkan chart yang ada jika sudah ada sebelumnya
        if (window.myChart) {
            window.myChart.destroy();
        }

        // Membuat chart menggunakan Chart.js sebagai Line Chart
        var ctx = document.getElementById('transactionLineChart').getContext('2d');
        window.myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: intervals,
                datasets: [{
                    label: 'Profit',
                    data: totals,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

        // Fungsi untuk menginisialisasi chart pertama kali
    drawTransactionLineChart(interval, total)
    console.log(interval)
    console.log(total)

        // Panggil fungsi untuk menggambar chart pada saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        // Fungsi untuk mengupdate chart saat menerima emit event dari Livewire
        Livewire.on('transactionLineChartUpdated', data => {
            console.log('Chart updated with data:', data); // Tambahkan log untuk melihat data yang diterima dari Livewire
            drawTransactionLineChart(data.intervals, data.totals);
        });
    });

</script>



<script>
    var labels = @json($labels);
    var datasets = @json($datasets);

    var colors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'];

    function drawPieTransactionMajorChart(labels, datasets) {
        // Hancurkan chart yang ada jika sudah ada sebelumnya
        if (window.transactionByMajor) {
            window.transactionByMajor.destroy();
        }

        // Membuat chart menggunakan Chart.js sebagai Line Chart
        var ctx2 = document.getElementById('memberDoughnutChart').getContext('2d');
        window.transactionByMajor = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: datasets,
                    backgroundColor: colors // Warna untuk setiap bagian pie chart
                }]
            },
            options: {
                responsive: true, // Membuat chart responsif
                plugins: {
                    legend: {
                        position: 'top', // Menampilkan legenda di atas chart
                    },
                    datalabels: {
                    color: '#fff', // Warna teks label
                    display: true, // Menampilkan label
                    formatter: function(value, ctx) {
                        var datasets = ctx.chart.data.datasets;
                        var total = datasets.reduce(function(sum, dataset) {
                            return sum + dataset.data.reduce(function(datasetSum, data) {
                                return datasetSum + data;
                            }, 0);
                        }, 0);
                        var percentage = (value * 100 / total).toFixed(2) + "%";
                        return percentage;
                    },
                    anchor: 'end', // Posisi label (start, center, end)
                    align: 'end' // Penyelarasan teks (start, center, end)
                    }
                }
            }
        });
    }
    console.log(labels)
    console.log(datasets)
    // Fungsi untuk menginisialisasi chart pertama kali
    drawPieTransactionMajorChart(labels, datasets)

    // Panggil fungsi untuk menggambar chart pada saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        // Fungsi untuk mengupdate chart saat menerima emit event dari Livewire
        Livewire.on('pieTransactionMajorChartUpdated', data => {
            console.log('Chart updated with data:', data); // Tambahkan log untuk melihat data yang diterima dari Livewire
            drawPieTransactionMajorChart(data.labels, data.datasets);
        });
    });

</script>

{{-- {{ dd($profitByPayment->pluck('total_profit')) }} --}}
<script>
    var paymentLabels = @json($paymentLabels);
    var profitByPayment = @json($profitByPayment->pluck('total_profit'));

    var colors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'];

    function drawPiePaymentChart(paymentLabels, profitByPayment) {
        // Hancurkan chart yang ada jika sudah ada sebelumnya
        if (window.transactionByPayment) {
            window.transactionByPayment.destroy();
        }

        // Membuat chart menggunakan Chart.js sebagai Line Chart
        var ctx3 = document.getElementById('paymentDoughnutChart').getContext('2d');
        window.transactionByPayment = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: paymentLabels,
                datasets: [{
                    data: profitByPayment,
                    backgroundColor: colors // Warna untuk setiap bagian pie chart
                }]
            },
            options: {
                responsive: true, // Membuat chart responsif
                plugins: {
                    legend: {
                        position: 'top', // Menampilkan legenda di atas chart
                    },
                    datalabels: {
                    color: '#fff', // Warna teks label
                    display: true, // Menampilkan label
                   }
                }
            }
        });
    }
    console.log(paymentLabels)
    console.log(profitByPayment)
    // Fungsi untuk menginisialisasi chart pertama kali
    drawPiePaymentChart(paymentLabels, profitByPayment)

    // Panggil fungsi untuk menggambar chart pada saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        // Fungsi untuk mengupdate chart saat menerima emit event dari Livewire
        Livewire.on('pieTransactionByPayment', data => {
            console.log('Chart updated with data:', data); // Tambahkan log untuk melihat data yang diterima dari Livewire
            drawPiePaymentChart(data.paymentLabels, data.profitByPayment);
        });
    });

</script>


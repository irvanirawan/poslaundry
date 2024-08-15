@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $bulan = Carbon::now()->translatedFormat('F');
@endphp

@extends('layout')

@section('content')
<div class="w-full">
    <div class="sm:flex block items-center mb-6">
        <div class="w-full flex justify-end items-center relative mb-0 mt-4 sm:mt-0" x-data="liveClock()" x-init="startClock()">
            <p class="text-gray-700 text-lg" x-text="formattedTime"></p>
        </div>
    </div>
</div>
<div class="row">
	<div class="xl:w-1/4 sm:w-1/2 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">582</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Menu Aktif</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-book"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="xl:w-1/4 sm:w-1/2 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">346</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Pelanggan</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-users"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="xl:w-1/4 sm:w-1/2 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">236</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Penjualan {{ $bulan }}</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-chart-line"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="xl:w-1/4 sm:w-1/2 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">582</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Piutang</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-money-bill-wave"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="xl:w-1/2 sm:w-1/1 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">Rp 0.00</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Total Penjualan Agustus</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-book"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="xl:w-1/2 sm:w-1/1 px-2">
		<div class="card">
			<div class="sm:p-[1.875rem] p-4">
				<div class="flex items-center">
					<div class="flex-1">
						<h2 class="text-dark font-semibold xl:text-[2.375rem] sm:text-[2rem] text-[25px] mb-2">Rp 0.00</h2>
						<span class="text-lg max-sm:text-base text-[#7e7e7e]">Total Piutang</span>
					</div>
					<span class="p-4 border border-border ml-4 rounded-full text-lg max-sm:text-base text-[#7e7e7e]">
						<i class="fas fa-users"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="xl:w-1/2 sm:w-1/1 px-2">
		<div class="card" x-data="chartData" x-init="renderChart()">
			<div class="flex justify-between items-center sm:py-6 py-5 sm:px-[1.875rem] px-4 relative border-b border-border z-[2]">
				<h4 class="text-xl">Terlaris</h4>
			</div>
			<div class="sm:p-[1.875rem] p-4">
				<div class="grid grid-rows-2 gap-4">
					<div class="flex justify-center">
						<div class="w-full h-auto">
							<canvas id="doughnut_chart_penjualan"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="xl:w-1/2 sm:w-1/1 px-2">
		<div class="card flex flex-col" x-data="chartData" x-init="renderBarChart()">
			<div class="flex justify-between items-center sm:py-6 py-5 sm:px-[1.875rem] px-4 border-b border-border">
				<h4 class="text-xl">Penjualan Tahun 2024</h4>
				<select x-model="selectedYear" @change="renderBarChart()" class="border border-gray-300 rounded-md text-sm py-2 px-3">
					<option value="2024">2024</option>
					<option value="2023">2023</option>
					<option value="2022">2022</option>
					<!-- Tambahkan opsi tahun lainnya sesuai kebutuhan -->
				</select>
			</div>
			<div class="flex-grow p-4">
				<div class="flex justify-center items-center h-full">
					<canvas id="bar_chart_penjualan" class="w-full h-full"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('mophy/assets/vendor/chart-js/chart.bundle.min.js')}}"></script>
<script src="{{ asset('mophy/assets/js/plugins-init/chartjs-init.js')}}"></script>
<script>
    function liveClock() {
        return {
            time: '',
            date: '',
            formattedTime: '',

            startClock() {
                this.updateTime();
                setInterval(() => {
                    this.updateTime();
                }, 1000);
            },

            updateTime() {
                const date = new Date();

                // Format tanggal: 11 Agustus 2024
                const dateOptions = { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric'
                };

                // Format waktu: 16:05:00
                const timeOptions = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                this.date = date.toLocaleDateString('id-ID', dateOptions);
                this.time = date.toLocaleTimeString('id-ID', timeOptions);
                
                // Gabungkan tanggal dan waktu dengan simbol | 
                this.formattedTime = `${this.date} | ${this.time}`;
            }
        }
    }
	document.addEventListener('alpine:init', () => {
        Alpine.data('chartData', () => ({
            selectedYear: '2024',
            renderChart() {
                const ctx = document.getElementById('doughnut_chart_penjualan').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pakaian', 'Selimut', 'Sepatu', 'Tas', 'Topi', 'Jaket', 'Kemeja', 'Celana', 'Kaos', 'Sweater'],
                        datasets: [{
                            data: [300, 50, 100, 40, 120, 50, 100, 40, 120, 50],
                            backgroundColor: ['#3490dc', '#38c172', '#ffed4a', '#f6993f', '#e3342f', '#6cb2eb', '#f66d9b', '#f566d2', '#f566d2', '#f566d2'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            },
			renderBarChart() {
                const ctx = document.getElementById('bar_chart_penjualan').getContext('2d');

                // Buat gradient untuk bar chart
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
                gradient.addColorStop(1, 'rgba(153, 102, 255, 0.6)');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                        datasets: [{
                            label: 'Penjualan',
                            data: [12000, 15000, 17000, 14000, 16000, 19000, 22000, 21000, 24000, 23000, 25000, 27000],
                            backgroundColor: gradient,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
								labels: {
									color: '#333',
									usePointStyle: true,
									layout: {
										padding: {
											bottom: 50 // Menambahkan jarak di bawah legend
										}
									}
								}
                            }
                        }
                    }
                });
            }
        }));
    });
</script>
@endpush
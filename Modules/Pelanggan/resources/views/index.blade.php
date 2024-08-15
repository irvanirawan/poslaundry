@extends('layout')

@push('styles')
    <link href="{{ asset('assets/css/custom-table.css') }}" rel="stylesheet">
@endpush

@push('header-title')
    Order
@endpush

@push('breadcumb')
<div class="py-[15px] px-[25px] bg-card rounded-lg shadow-[0_2px_10px_-3px_rgba(0,0,0,0.09)] flex items-center mb-[1.875rem]">
    <ol class="flex">
        <li><a href="javascript:void(0)" class="text-[#828690]">Data Master</a></li>
        <li class="text-primary font-semibold pl-2">
            <a href="javascript:void(0)">Pelanggan</a>
        </li>
    </ol>           
</div>
@endpush

@section('content')
<div class="row">

    <div x-data="crud" class="w-full">
        <div class="card">
            <div class="sm:p-[1.875rem] p-4">
                <ul class="nav nav-tabs flex flex-wrap border-b border-border">
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link py-2 px-4 font-medium block border-b-[3px] border-transparent text-primary"
                            @click.prevent="$store.common.activeTab = 'tab-table'"
                            :class="{ 'border-b-primary': $store.common.activeTab == 'tab-table'}">
                            <i class="la la-table mr-2"></i> Data Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link py-2 px-4 font-medium block border-b-[3px] border-transparent text-primary"
                            @click.prevent="$store.common.activeTab = 'tab-form'"
                            :class="{ 'border-b-primary': $store.common.activeTab == 'tab-form'}">
                            <i class="la la-plus-circle mr-2"></i> Tambah Pelanggan
                        </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="float-right flex items-center space-x-4 relative" x-data="{ openselectcolumn: false }">
                            <div class="relative inline-block text-left">
                                <div x-show="$store.common.activeTab == 'tab-table'" x-transition:enter="transition-all duration-700 easy-in-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <button @click="openselectcolumn = !openselectcolumn" class="px-4 py-2 min-w-[6.875rem] inline-block rounded-lg py-[0.438rem] text-sm border border-gray-200 text-gray-500 hover:bg-primary hover:text-white duration-300 btn-xs">
                                        Pilih kolom <span class="">&#x25BE;</span>
                                    </button>
                                    <div x-show="openselectcolumn" @click.away="openselectcolumn = false" x-transition class="z-50 absolute right-0 w-96 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="px-4 pt-2">
                                                <div class="flex flex-wrap">
                                                    <template x-for="(column, index) in columns" :key="index">
                                                        <div class="w-1/2">
                                                            <label class="flex items-center mr-4 mb-2">
                                                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" x-on:click="toggleColumn(index)" checked>
                                                                <span x-text="column" class="ml-2 text-gray-700"></span>
                                                            </label>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="tab-content-area">
                    <div x-show="$store.common.activeTab == 'tab-table'" x-transition>
                        <div class="pt-6 relative">
                            <div id="loadingtable" class="flex justify-center items-center absolute inset-0 bg-opacity-50 z-50 hidden">
                                <div class="w-16 h-16 border-4 border-dashed rounded-full animate-spin border-blue-500"></div>
                            </div>
                            <table id="primaryTable" class="display table w-full">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-cog"></i></th>
                                        <th>Kode Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Status</th>
                                        <th>Operator</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div x-show="$store.common.activeTab == 'tab-form'" x-transition>
                        <form class="p-6" @submit.prevent="saveSubmitPrevent">
                            <div class="mb-4">
                                <label for="kode" class="block text-gray-700 text-sm font-bold mb-2">Kode Pelanggan:</label>
                                <input type="text" x-model="kode" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Kode Pelanggan" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelanggan:</label>
                                <input type="text" x-model="nama" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Nama Pelanggan" >
                            </div>
                            <div class="mb-4">
                                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                                <input type="text" x-model="alamat" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Alamat" >
                            </div>
                            <div class="mb-4">
                                <label for="telepon" class="block text-gray-700 text-sm font-bold mb-2">Telepon:</label>
                                <input type="text" x-model="telepon" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Telepon" >
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <select x-model="status" class="form-select text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-primary text-white bg-primary hover:bg-hover-primary hover:border-hover-primary duration-300" :class="{ 'opacity-50 cursor-not-allowed': saving }" :disabled="saving">
                                    <span x-show="!saving">Save</span>
                                    <span x-show="saving">Saving...</span>
                                </button>
                                <button type="button" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-danger bg-danger text-white hover:bg-danger-hover duration-300" @click="reset">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    var dataPrimary = [];
    const primaryTable = $('#primaryTable').DataTable({
        responsive: true,
        "ajax": {
            "url": "/api/pelanggan",
            "type": "GET",
            "error": function(xhr) {
                const message = xhr.responseJSON.message || 'Data gagal dimuat';
                alert(message);
            },
            "complete": function() {
                setTimeout(() => {
                    $('#primaryTable').removeClass('opacity-50 cursor-not-allowed');
                    $('#loadingtable').addClass('hidden');
                }, 600);
            },
            "dataSrc": function(json) {
                dataPrimary = json;
                return json;
            }
        },
        "columns": [
            {
                data: 'id',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-lg btn-primary" @click="editItem(${row.id})">
                            <i class="la la-pencil"></i>
                        </button>
                        <button class="btn btn-lg btn-danger" @click="deleteItem(${row.id})">
                            <i class="la la-trash"></i>
                        </button>
                    `;
                }
            },
            { data: 'kode' },
            { data: 'nama' },
            { data: 'alamat' },
            { data: 'telepon' },
            { data: 'status' },
            { data: 'status' }
        ]
    });
    document.addEventListener('alpine:init', () => {
        Alpine.data('crud', () => ({
            id: '',
            kode: '',
            nama: '',
            alamat: '',
            telepon: '',
            status: 'aktif',
            saving: false,
            deleting: false,
            columns: ['Action', 'Kode Pelanggan', 'Nama Pelanggan', 'Alamat', 'Telepon', 'Status', 'Operator'],
            toggleColumn(column) {
                primaryTable.column(column).visible(!primaryTable.column(column).visible());
            },
            saveSubmitPrevent() {
                $('#primaryTable').addClass('opacity-50 cursor-not-allowed');
                $('#loadingtable').removeClass('hidden');
                this.saving = true;
                const method = this.id ? 'PUT' : 'POST';
                const url = this.id ? '/api/pelanggan/' + this.id : '/api/pelanggan';
                const data = {
                    kode: this.kode,
                    nama: this.nama,
                    alamat: this.alamat,
                    telepon: this.telepon,
                    status: this.status
                };
                console.log(data);
                
                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    const message = data.message || 'Data berhasil disimpan';
                    const typeToast = response.ok ? 'success' : 'warning';
                    Alpine.store('common').toastShow(typeToast, message);
                    primaryTable.ajax.reload();
                    this.saving = false;
                    this.reset();
                })
                .catch(error => {
                    const message = error.message || 'Data gagal disimpan';
                    Alpine.store('common').toastShow('error', message);
                    this.saving = false;
                    primaryTable.ajax.reload();
                    this.reset();
                });
            },
            editItem(id) {
                const item = dataPrimary.find(item => item.id === id);
                this.id = item.id;
                this.kode = item.kode;
                this.nama = item.nama;
                this.alamat = item.alamat;
                this.telepon = item.telepon;
                this.status = item.status;
                Alpine.store('common').activeTab = 'tab-form';
            },
            async deleteItem(id) {
                const item = dataPrimary.find(item => item.id === id);
                if (confirm('Anda yakin ingin menghapus ' + item.kode + '?')) {
                    $('#primaryTable').addClass('opacity-50 cursor-not-allowed');
                    this.deleting = true;
                    const url = '/api/pelanggan/' + id;
                    fetch(url, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        const message = data.message || 'Data berhasil dihapus';
                        const typeToast = response.ok ? 'success' : 'warning';
                        Alpine.store('common').toastShow(typeToast, message);
                        primaryTable.ajax.reload();
                        this.deleting = false;
                    })
                    .catch(error => {
                        const message = error.message || 'Data gagal dihapus';
                        Alpine.store('common').toastShow('error', message);
                        this.deleting = false;
                        primaryTable.ajax.reload();
                    });
                }
            },
            reset() {
                this.id = '';
                this.kode = '';
                this.nama = '';
                this.alamat = '';
                this.telepon = '';
                this.status = '';
                Alpine.store('common').activeTab = 'tab-table';
            }
        }));
    });
</script>
@endpush

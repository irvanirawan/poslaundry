@extends('layout')

@push('styles')
    <link href="{{ asset('assets/css/custom-table.css') }}" rel="stylesheet">
@endpush

@push('header-title')
    Kategori
@endpush

@push('breadcumb')
<div class="form-head mb-6">
    <h3 class="text-dark font-semibold mb-0">Kategori</h3>
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
                            <i class="la la-table mr-2"></i> Data Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link py-2 px-4 font-medium block border-b-[3px] border-transparent text-primary"
                            @click.prevent="$store.common.activeTab = 'tab-form'"
                            :class="{ 'border-b-primary': $store.common.activeTab == 'tab-form'}">
                            <i class="la la-plus-circle mr-2"></i> Tambah Kategori
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
                    <div x-show="$store.common.activeTab == 'tab-table'"
                        x-transition:enter="transition-all duration-700 easy-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100">
                        <div class="pt-6 relative">
                            <div id="loadingtable" class="flex justify-center items-center absolute inset-0 bg-opacity-50 z-50 hidden">
                                <div class="w-16 h-16 border-4 border-dashed rounded-full animate-spin border-blue-500"></div>
                            </div>
                            <table id="primaryTable" class="display table w-full">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-cog"></i></th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Kelompok</th>
                                        <th>Operator</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div x-show="$store.common.activeTab == 'tab-form'"
                        x-transition:enter="transition-all duration-700 easy-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100">
                        <form class="p-6" @submit.prevent="saveSubmitPrevent">
                            <div class="mb-4">
                                <label for="kode" class="block text-gray-700 text-sm font-bold mb-2">Kode:</label>
                                <input type="text" x-model="kode" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Kode " required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                                <input type="text" x-model="nama" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Enter Nama " >
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <select x-model="status" class="form-select text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="kelompok" class="block text-gray-700 text-sm font-bold mb-2">Kelompok:</label>
                                <select x-model="kelompok" class="form-select text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" required>
                                    <option value="">Pilih Kelompok</option>
                                    <template x-for="item in datakelompok" :key="item.id">
                                        <option x-bind:value="item.id" x-text="item.kode + ' - ' + item.nama"></option>
                                    </template>
                                </select>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-primary text-white bg-primary hover:bg-hover-primary hover:border-hover-primary duration-300" :class="{ 'opacity-50 cursor-not-allowed': saving }" :disabled="saving">
                                    <span x-show="!saving">Save</span>
                                    <span x-show="saving">Saving...</span>
                                </button>
                                <button type="button" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-danger bg-danger text-white hover:bg-danger-hover duration-300" @click="resetForm">Cancel</button>
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
            "url": "/api/category",
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
            { data: 'status' },
            { data: 'category_group',
                render: function(data, type, row) {
                    const kode = row.category_group ? row.category_group.kode : '';
                    const name = row.category_group ? row.category_group.nama : '';
                    return `${kode} - ${name}`;
                }
            },
            { data: 'created_by_user',
                render: function(data, type, row) {
                    const name = row.created_by_user ? row.created_by_user.name : '-';
                    return name;
                }
            }
        ]
    });
    document.addEventListener('alpine:init', () => {
        Alpine.data('crud', () => ({
            id: '',
            kode: '',
            nama: '',
            status: 'aktif',
            kelompok: '',
            datakelompok: @json($categoryGroup),
            saving: false,
            deleting: false,
            columns: ['Action', 'Kode', 'Nama', 'Status', 'Kelompok', 'Operator'],

            toggleColumn(column) {
                primaryTable.column(column).visible(!primaryTable.column(column).visible());
            },

            saveSubmitPrevent() {
                this.saving = true;
                this.setLoadingState(true);
                const method = this.id ? 'PUT' : 'POST';
                const url = this.id ? `/api/category/${this.id}` : '/api/category';
                const data = {
                    kode: this.kode,
                    nama: this.nama,
                    status: this.status,
                    category_group_id: this.kelompok
                };

                this.sendRequest(url, method, data)
                    .then(response => this.handleResponse(response, 'Data berhasil disimpan'))
                    .catch(error => this.handleResponse(error, 'Data gagal disimpan', true))
                    .finally(() => {
                        this.saving = false;
                        this.resetForm();
                    });
            },

            editItem(id) {
                const item = dataPrimary.find(item => item.id === id);
                if (item) {
                    this.id = item.id;
                    this.kode = item.kode;
                    this.nama = item.nama;
                    this.status = item.status;
                    this.kelompok = item.category_group_id;
                    Alpine.store('common').activeTab = 'tab-form';
                }
            },

            async deleteItem(id) {
                const item = dataPrimary.find(item => item.id === id);
                if (item && confirm(`Anda yakin ingin menghapus ${item.kode}?`)) {
                    this.deleting = true;
                    this.setLoadingState(true);
                    const url = `/api/category/${id}`;
                    
                    this.sendRequest(url, 'DELETE')
                        .then(response => this.handleResponse(response, 'Data berhasil dihapus'))
                        .catch(error => this.handleResponse(error, 'Data gagal dihapus', true))
                        .finally(() => this.deleting = false);
                }
            },

            resetForm() {
                this.id = '';
                this.kode = '';
                this.nama = '';
                this.status = 'aktif';
                this.kelompok = '';
                Alpine.store('common').activeTab = 'tab-table';
            },

            setLoadingState(isLoading) {
                $('#primaryTable').toggleClass('opacity-50 cursor-not-allowed', isLoading);
                if (isLoading) {
                    $('#loadingtable').removeClass('hidden');
                } else {
                    $('#loadingtable').addClass('hidden');
                }
            },

            sendRequest(url, method, data = null) {
                return fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: data ? JSON.stringify(data) : null
                }).then(response => response.json().then(data => ({ data, response })));
            },

            handleResponse({ data, response }, defaultMessage, isError = false) {
                const message = data.message || defaultMessage;
                const typeToast = isError ? 'error' : (response.ok ? 'success' : 'warning');
                Alpine.store('common').toastShow(typeToast, message);
                primaryTable.ajax.reload();
            }
        }));
    });
</script>
@endpush

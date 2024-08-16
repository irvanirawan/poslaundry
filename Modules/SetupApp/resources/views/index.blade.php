@extends('layout')

@push('styles')

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
    <div x-data="crud" class="w-full" x-init="init()">
        <div class="card">
            <div class="sm:p-[1.875rem] p-4">
                <ul class="nav nav-tabs flex flex-wrap border-b border-border">
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link py-2 px-4 font-medium block border-b-[3px] border-transparent text-primary"
                            @click.prevent="$store.common.activeTab = 'tab-pajakpb1'"
                            :class="{ 'border-b-primary': $store.common.activeTab == 'tab-pajakpb1' || $store.common.activeTab == 'tab-table'}">
                            <i class="la la-table mr-2"></i> Pajak PB1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link py-2 px-4 font-medium block border-b-[3px] border-transparent text-primary"
                            @click.prevent="$store.common.activeTab = 'tab-formatstruk'"
                            :class="{ 'border-b-primary': $store.common.activeTab == 'tab-formatstruk'}">
                            <i class="la la-plus-circle mr-2"></i> Format Struk
                        </a>
                    </li>
                </ul>
                <div class="tab-content-area">
                    <div x-show="$store.common.activeTab == 'tab-pajakpb1' || $store.common.activeTab == 'tab-table'"
                        x-transition:enter="transition-all duration-700 easy-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100">
                        <form class="p-6" @submit.prevent="saveSubmitPrevent">
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="pajak_pb1" class="block text-gray-700 text-sm font-bold mb-2">Pajak PB1:</label>
                                <input type="text" x-model="pajak_pb1" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Persentase Pajak PB1 ...">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-primary text-white bg-primary hover:bg-hover-primary hover:border-hover-primary duration-300" :class="{ 'opacity-50 cursor-not-allowed': saving }" :disabled="saving">
                                    <span x-show="!saving">Save</span>
                                    <span x-show="saving">Saving...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div x-show="$store.common.activeTab == 'tab-formatstruk'"
                        x-transition:enter="transition-all duration-700 easy-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100">
                        <form class="p-6 flex flex-wrap -mx-2" @submit.prevent="saveSubmitPrevent">
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_header1" class="block text-gray-700 text-sm font-bold mb-2">Header 1:</label>
                                <input type="text" x-model="struk_header1" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Header 1 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_footer1" class="block text-gray-700 text-sm font-bold mb-2">Footer 1:</label>
                                <input type="text" x-model="struk_footer1" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Footer 1 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_header2" class="block text-gray-700 text-sm font-bold mb-2">Header 2:</label>
                                <input type="text" x-model="struk_header2" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Header 2 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_footer2" class="block text-gray-700 text-sm font-bold mb-2">Footer 2:</label>
                                <input type="text" x-model="struk_footer2" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Footer 2 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_header3" class="block text-gray-700 text-sm font-bold mb-2">Header 3:</label>
                                <input type="text" x-model="struk_header3" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Header 3 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_footer3" class="block text-gray-700 text-sm font-bold mb-2">Footer 3:</label>
                                <input type="text" x-model="struk_footer3" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Footer 3 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_header4" class="block text-gray-700 text-sm font-bold mb-2">Header 4:</label>
                                <input type="text" x-model="struk_header4" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Header 4 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_footer4" class="block text-gray-700 text-sm font-bold mb-2">Footer 4:</label>
                                <input type="text" x-model="struk_footer4" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Footer 4 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_header5" class="block text-gray-700 text-sm font-bold mb-2">Header 5:</label>
                                <input type="text" x-model="struk_header5" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Header 5 ...">
                            </div>
                            <div class="mb-4 w-full sm:w-1/2 px-2">
                                <label for="struk_footer5" class="block text-gray-700 text-sm font-bold mb-2">Footer 5:</label>
                                <input type="text" x-model="struk_footer5" class="form-control text-[13px] h-[2.813rem] border border-border block rounded-lg py-1.5 px-3 w-full" placeholder="Input Footer 5 ...">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="mr-1 mb-2 min-w-[6.875rem] inline-block rounded-lg max-sm:text-sm px-4 sm:px-[0.938rem] py-2.5 border border-primary text-white bg-primary hover:bg-hover-primary hover:border-hover-primary duration-300" :class="{ 'opacity-50 cursor-not-allowed': saving }" :disabled="saving">
                                    <span x-show="!saving">Save</span>
                                    <span x-show="saving">Saving...</span>
                                </button>
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
    var data = @json($data);
    document.addEventListener('alpine:init', () => {
        Alpine.data('crud', () => ({
            saving: false,
            pajak_pb1: '',
            struk_header1: '',
            struk_header2: '',
            struk_header3: '',
            struk_header4: '',
            struk_header5: '',
            struk_footer1: '',
            struk_footer2: '',
            struk_footer3: '',
            struk_footer4: '',
            struk_footer5: '',
            init() {
                this.pajak_pb1 = data.pajak_pb1;
                this.struk_header1 = data.struk_header1;
                this.struk_header2 = data.struk_header2;
                this.struk_header3 = data.struk_header3;
                this.struk_header4 = data.struk_header4;
                this.struk_header5 = data.struk_header5;
                this.struk_footer1 = data.struk_footer1;
                this.struk_footer2 = data.struk_footer2;
                this.struk_footer3 = data.struk_footer3;
                this.struk_footer4 = data.struk_footer4;
                this.struk_footer5 = data.struk_footer5;
            },
            saveSubmitPrevent() {
                this.saving = true;
                this.sendRequest('/api/setupapp', 'PUT', {
                    pajak_pb1: parseInt(this.pajak_pb1),
                    struk_header1: this.struk_header1,
                    struk_header2: this.struk_header2,
                    struk_header3: this.struk_header3,
                    struk_header4: this.struk_header4,
                    struk_header5: this.struk_header5,
                    struk_footer1: this.struk_footer1,
                    struk_footer2: this.struk_footer2,
                    struk_footer3: this.struk_footer3,
                    struk_footer4: this.struk_footer4,
                    struk_footer5: this.struk_footer5,
                }).then(response => {
                    if (response.response.status == 200) {
                        this.saving = false;
                    } else {
                        this.saving = false;
                        alert('Failed to save data');
                    }
                });
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
        }));
    });
</script>
@endpush

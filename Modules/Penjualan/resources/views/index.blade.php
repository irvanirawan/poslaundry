@extends('layout')

@push('styles')
<style>
    .container-fluid {
        padding-top: 1rem;
    }
    .custom-shadow-flat {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-shadow-flat-hover:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .custom-bg-gradient-blue {
        background: linear-gradient(135deg, #4f93ce, #285a8d);
    }

    .custom-bg-gradient-green {
        background: linear-gradient(135deg, #56c596, #3a8b6e);
    }

    .categories-container, h2, button, .product-card h2, .product-card p {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        color: #285a8d;
    }

    .categories {
        overflow-x: auto;
        white-space: nowrap;
        scroll-behavior: smooth;
        padding: 8px 0 8px 0;
        padding-right: 50px;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .categories::-webkit-scrollbar {
        display: none;
    }

    .category-btn {
        padding: 4px 10px;
        background: linear-gradient(135deg, #4f93ce, #285a8d);
        color: white;
        border-radius: 9999px;
        font-size: 0.875rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        display: inline-block;
        margin-right: 5px;
    }

    .category-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .category-btn.selected {
        background: linear-gradient(135deg, #56c596, #3a8b6e);
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .scroll-indicator::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: 50px;
        pointer-events: none;
    }

    .product-card {
        padding: 16px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        height: auto;
    }

    .cart-payment {
        background: linear-gradient(135deg, #f3f4f6, #e2e8f0);
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        max-height: 100vh;
        transition: all 0.3s ease-in-out;
    }

    .cart-payment h2 {
        font-size: 1.25rem;
        color: #285a8d;
        margin-bottom: 12px;
    }

    .cart-items-container {
        max-height: 350px;
        overflow-y: auto;
        margin-bottom: 12px;
        padding-right: 6px;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .cart-items-container::-webkit-scrollbar {
        display: none;
    }

    .cart-item {
        background-color: white;
        border-radius: 8px;
        padding: 8px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 8px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .cart-item .item-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-item h3 {
        font-size: 0.875rem;
        color: #285a8d;
        margin-bottom: 2px;
    }

    .cart-item p {
        font-size: 0.75rem;
        color: #4a5568;
    }

    .cart-controls button {
        background-color: #e2e8f0;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 0.75rem;
        color: #285a8d;
        transition: background-color 0.2s;
    }

    .cart-controls button:hover {
        background-color: #cbd5e0;
    }

    .item-note {
        border: none;
        border-bottom: 2px solid #e2e8f0;
        padding: 6px;
        width: 100%;
        font-size: 0.75rem;
        color: #285a8d;
        transition: border-color 0.2s;
    }

    .item-note:focus {
        border-color: #4f93ce;
        outline: none;
    }

    .total {
        font-size: 1rem;
        font-weight: 600;
        color: #285a8d;
        margin-bottom: 12px;
    }

    .amount-buttons button {
        background-color: #285a8d;
        color: white;
        border-radius: 8px;
        padding: 6px;
        font-size: 0.75rem;
        transition: background-color 0.2s;
    }

    .amount-buttons button:hover {
        background-color: #4f93ce;
    }

    .payment-input {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px;
        width: 100%;
        margin-bottom: 12px;
        font-size: 0.875rem;
        color: #285a8d;
        transition: border-color 0.2s;
    }

    .payment-input:focus {
        border-color: #4f93ce;
        outline: none;
    }

    .submit-btn {
        background: linear-gradient(135deg, #4f93ce, #285a8d);
        color: white;
        border-radius: 8px;
        padding: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background-color 0.2s;
        width: 100%;
        text-align: center;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, #285a8d, #4f93ce);
    }

    .search-container {
        background: linear-gradient(135deg, #f3f4f6, #e2e8f0);
        border-radius: 16px;
        padding: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }

    .search-input {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px;
        width: 100%;
        font-size: 0.875rem;
        color: #285a8d;
        transition: border-color 0.2s;
        margin-left: 8px;
    }

    .search-input:focus {
        border-color: #4f93ce;
        outline: none;
    }

    .cart-icons-container {
        display: flex;
        align-items: center;
        font-size: 1.25rem;
        color: #285a8d;
        justify-content: space-between;
    }

    .cart-count {
        background-color: #285a8d;
        color: white;
        border-radius: 9999px;
        padding: 4px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 2px;
    }

    .trash-icon {
        margin-left: auto;
        font-size: 1.25rem;
        color: #285a8d;
        cursor: pointer;
        transition: color 0.2s;
    }

    .trash-icon:hover {
        color: #4f93ce;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .w-2/3, .w-1/3 {
            width: 100%;
        }

        .cart-payment {
            margin-top: 16px;
            width: 100%;
        }

        .cart-items-container {
            max-height: 200px;
        }

        .cart-item {
            padding: 6px;
        }

        .product-card {
            padding: 12px;
        }

        .category-btn {
            font-size: 0.75rem;
            padding: 2px 8px;
        }

        .search-container {
            padding: 8px;
        }

        .search-input {
            padding: 6px;
        }

        .amount-buttons button {
            padding: 4px;
        }

        .submit-btn {
            padding: 8px;
        }
    }
</style>
@endpush

@push('header-title')
    Penjualan
@endpush

@section('content')
<div x-data="posApp()" class="grid grid-cols-12 xl:gap-[20px]">
    <div class="xl:col-span-8 col-span-12 xl:row-span-2">
        <div class="w-full">
            <div class="w-full md:w-2/3 pl-2" style="scrollbar-width: none;">
                <div class="search-container mb-4">
                    <i class="fas fa-search text-blue-400 fa-lg"></i>
                    <input type="text" placeholder="Cari layanan ..." class="search-input focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="categories-container">
                    <div class="categories flex items-center gap-2 mb-4">
                        <template x-for="category in categories" :key="category.id">
                            <button @click="filterItemsByCategory(category.id)" :class="{ 'selected': selectedCategoryId === category.id }" class="category-btn">
                                <span x-text="category.nama"></span>
                            </button>
                        </template>
                    </div>
                    <div class="scroll-indicator"></div>
                </div>
                <div class="grid grid-cols-2 xs:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 overflow-y-auto max-h-screen" style="scrollbar-width: none;">
                    <template x-for="item in filteredItems" :key="item.id">
                        <div class="product-card shadow-flat hover:shadow-flat-hover transition-shadow duration-200" @click="addToCart(item)">
                            <div class="h-24 flex items-center justify-center bg-blue-50 rounded mb-4">
                                <img :src="`/path/to/images/${item.gambar}`" alt="" class="h-full object-contain">
                            </div>
                            <h2 class="text-lg font-bold" x-text="item.nama"></h2>
                            <p class="font-semibold" x-text="`Rp. ${formatNumber(item.hargajual)}`"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div class="xl:col-span-4 xl:row-span-2 lg:col-span-6 col-span-12">
        <div class="w-full">
            <div class="p-4 h-full cart-payment">
                <div>
                    <div class="border-b pb-2 mb-4">
                        <div class="cart-icons-container">
                            <div class="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count align-super text-xs" x-text="cartItems.length"></span>
                            </div>
                            <i class="fas fa-trash trash-icon" @click="clearCart()" x-show="cartItems.length > 0"></i>
                        </div>
                    </div>
                    <template x-if="cartItems.length === 0">
                        <div class="empty-cart flex flex-col items-center justify-center text-center py-10">
                            <i class="fas fa-shopping-cart text-gray-400 fa-4x mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600">Keranjang Kosong</h3>
                            <p class="text-gray-500">Tambahkan beberapa item ke dalam keranjang untuk memulai transaksi.</p>
                        </div>
                    </template>
                    <div class="cart-items-container">
                        <template x-for="(cartItem, index) in cartItems" :key="index">
                            <div class="cart-item">
                                <div class="item-info">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-blue-50 rounded mr-2 flex items-center justify-center">
                                            <i class="fas fa-tshirt text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold">
                                                <span x-text="cartItem.nama"></span>
                                            </h3>
                                            <p class="font-semibold">Rp. 
                                                <span x-text="formatNumber(cartItem.hargajual)"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 cart-controls">
                                        <button class="hover:bg-gray-400 transition-colors" @click="decreaseQuantity(index)">
                                            <i class="fas fa-minus text-gray-700"></i>
                                        </button>
                                        <span class="px-2">
                                            <span x-text="cartItem.quantity"></span>
                                        </span>
                                        <button class="hover:bg-gray-400 transition-colors" @click="increaseQuantity(index)">
                                            <i class="fas fa-plus text-gray-700"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="text" placeholder="Tambahkan catatan" class="item-note focus:outline-none focus:ring-2 focus:ring-blue-500" x-model="cartItem.note" />
                            </div>
                        </template>
                    </div>
                </div>
                <div>
                <h2 class="total" x-text="`Total: Rp. ${totalAmount}`"></h2>
                    <div class="grid grid-cols-3 gap-2 mb-4 amount-buttons">
                        <button @click="addPaymentAmount(2000)">+ 2.000</button>
                        <button @click="addPaymentAmount(5000)">+ 5.000</button>
                        <button @click="addPaymentAmount(10000)">+ 10.000</button>
                        <button @click="addPaymentAmount(20000)">+ 20.000</button>
                        <button @click="addPaymentAmount(50000)">+ 50.000</button>
                        <button @click="addPaymentAmount(100000)">+ 100.000</button>
                    </div>
                    <input type="text" placeholder="Rp" class="payment-input focus:outline-none focus:ring-2 focus:ring-blue-500" x-model="paymentAmount" />
                    <button class="submit-btn" @click="submitPayment()">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function posApp() {
        return {
            searchQuery: '',
            selectedCategoryId: null,
            categories: @json($categories),
            items: @json($items),
            cartItems: [],
            filteredItems: [],
            paymentAmount: 0,

            init() {
                this.filteredItems = this.items;
            },

            formatNumber(value) {
                return value.toLocaleString('id-ID'); // Format sesuai lokal Indonesia
            },

            filterItemsByCategory(categoryId) {
                this.selectedCategoryId = categoryId;
                this.filteredItems = this.items.filter(item => item.kategori_id === categoryId);
            },

            increaseQuantity(index) {
                this.cartItems[index].quantity++;
            },

            decreaseQuantity(index) {
                if (this.cartItems[index].quantity > 1) {
                    this.cartItems[index].quantity--;
                } else {
                    this.cartItems.splice(index, 1);
                }
            },

            addToCart(item) {
                const existingItemIndex = this.cartItems.findIndex(cartItem => cartItem.id === item.id);
                if (existingItemIndex !== -1) {
                    this.cartItems[existingItemIndex].quantity++;
                } else {
                    this.cartItems.push({ ...item, quantity: 1, note: '' });
                }
            },

            clearCart() {
                this.cartItems = [];
            },

            addPaymentAmount(amount) {
                this.paymentAmount += amount;
            },

            get totalAmount() {
                return this.cartItems.reduce((total, item) => total + (item.hargajual * item.quantity), 0);
            },

            submitPayment() {
                alert(`Pembayaran sebesar Rp. ${this.paymentAmount} telah diterima. Total belanja: Rp. ${this.totalAmount}`);
                this.clearCart();
                this.paymentAmount = 0;
            }
        }
    }
</script>
@endpush

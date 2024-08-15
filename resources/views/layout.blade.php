<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Title-->
		<title>Point of Sales</title>

		<!-- Meta -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="POS" />
		<meta name="robots" content="index, follow" />

		<meta name="keywords" content="Point of Sales" />

		<meta name="description" content="Point of Sales" />

		<meta property="og:title" content="Point of Sales" />
		<meta property="og:description" content="Point of Sales" />
		<meta property="og:image" content="../social-image.png" />

		<meta name="format-detection" content="telephone=no" />

		<meta name="twitter:title" content="Point of Sales" />
		<meta name="twitter:description" content="Point of Sales" />
		<meta name="twitter:image" content="../social-image.png" />
		<meta name="twitter:card" content="summary_large_image" />

		<!-- MOBILE SPECIFIC -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- FAVICONS ICON -->
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}" />

		<!-- ICONS -->
		<link rel="stylesheet" href="{{ asset('assets/icons/fontawesome/css/all.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/icons/line-awesome/css/line-awesome.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/icons/flaticon/flaticon.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/icons/themify-icons/css/themify-icons.css')}}" />

		<!-- NICE SELECT -->
		<link href="{{ asset('assets/vendor/niceselect/css/nice-select.css')}}" rel="stylesheet" />

		<!-- STYLE CSS. -->
		<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/vendor/datatables/css/responsive.dataTables.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('fontawesome-6.5.2/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/icons/line-awesome/css/line-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/icons/flaticon/flaticon.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/icons/themify-icons/css/themify-icons.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
		<!-- NICE SELECT -->
		<link href="{{ asset('assets/vendor/niceselect/css/nice-select.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/vendor/jquery-ascolorpicker/css/ascolorpicker.min.css') }}" rel="stylesheet">		
		@vite('resources/css/app.css')
		<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
        <style>
            .nav-text {
                max-width: 150px; /* Atur lebar maksimum sesuai kebutuhan */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                font-size: 12px;
            }
        </style>
		@stack('styles')
	</head>
	<body class="selection:text-white selection:bg-primary">
		<!-- Preloader start  -->
		<div id="preloader" class="fixed w-full h-full left-0 top-0 bg-white">
			<div class="sk-three-bounce w-full h-full text-center bg-white">
				<div class="relative top-[50%] size-5 bg-[#1EAAE7] rounded-full inline-block sk-child sk-bounce1"></div>
				<div class="relative top-[50%] size-5 bg-[#1EAAE7] rounded-full inline-block sk-child sk-bounce2"></div>
				<div class="relative top-[50%] size-5 bg-[#1EAAE7] rounded-full inline-block sk-child sk-bounce3"></div>
			</div>
		</div>
		<!-- Preloader end -->

		<!-- Main wrapper start -->
		<div id="main-wrapper" class="relative">
			<!-- Nav header start -->
			<div class="nav-header">
				<a href="index.html" class="brand-logo">
					<img class="logo-abbr" src="https://kavelia.siskasoftware.com/files/img/logo/logo-mono.svg" alt="" />
					<img class="logo-compact" src="https://kavelia.siskasoftware.com/files/img/logo/logo-light.svg" alt="" />
					<img class="brand-title" src="https://kavelia.siskasoftware.com/files/img/logo/logo-light.svg" alt="" />
				</a>
				<div class="nav-control">
					<div class="hamburger"><span class="line"></span><span class="line"></span><span class="line"></span></div>
				</div>
			</div>
			<!-- Nav header end -->

			<!-- Header start -->
			<div class="header">
				<div class="header-content">
					<nav class="navbar navbar-expand">
						<div class="navbar-collapse justify-between">
							<div class="header-left">
								<div class="dashboard_bar">
									<!-- <div class="input-group search-area relative lg:inline-flex hidden">
										<div class="input-group-text min-w-[3.125rem] justify-center flex items-center text-sm h-12 py-1.5 pl-3 leading-[1.5] text-center rounded-s-md bg-body">
											<button class="input-group-text search_icon search_icon font-normal">
												<i class="flaticon-381-search-2 text-ph text-base"></i>
											</button>
										</div>
										<input type="text" class="form-control px-3 py-1.5 text-sm h-12 outline-none w-[1%] rounded-s-none flex-auto bg-body text-ph placeholder-ph" placeholder="Search here..." />
									</div> -->
								</div>
							</div>
							<ul class="navbar-nav header-right flex h-full">
								<li class="nav-item flex items-center h-full relative notification_dropdown">
									<a class="nav-link relative text-primary bg-light rounded-full p-3 max-xxl:p-2.5 leading-[1] mr-[18px] max-sm:mr-[13px] text-lg bell dz-theme-mode" href="javascript:void(0);">
										<i id="icon-light" class="fas fa-sun scale-[1.4] max-xxl:scale-[1.2] text-white"></i>
										<i id="icon-dark" class="fas fa-moon scale-[1.4] max-xxl:scale-[1.2]"></i>
									</a>
								</li>

								<li class="nav-item flex items-center h-full relative header-profile" x-data="{ open: false }">
									<a @click="open = true" class="nav-link flex items-center ml-4 dz-dropdown" href="javascript:void(0)">
										<div class="header-info text-right pr-[15px] max-sm:hidden">
											<span class="text-base block">Hello,<strong class="font-semibold">Admin</strong></span>
											<p class="text-xs leading-[1.3]">Super Admin</p>
										</div>
										<!-- <img src="assets/images/profile/17.jpg" class="rounded-full w-[57px] h-[57px] max-xxl:h-[39px] max-xxl:w-[39px]" width="20" alt="" /> -->
                                         <i class="fa-regular fa-user-circle text-[#7e7e7e] text-2xl"></i>
									</a>
									<div class="absolute z-[9] shadow-[0_0_37px_rgba(8,21,66,0.05)] min-w-[12.5rem] py-[15px] mt-0.5 top-full max-md-top-[45px] right-0 rounded-lg bg-card"
										x-transition.duration.100ms
										x-show.transition.origin.top.right="open"
										x-cloak
										@click.away="open = false">
										<a href="page-login.html" class="dropdown-item block text-left w-full py-2 px-6 text-[#7e7e7e] duration-300 hover:bg-bs-dropdown-color hover:text-primary">
											<svg
												id="icon-logout"
												xmlns="http://www.w3.org/2000/svg"
												class="text-danger"
												width="18"
												height="18"
												viewBox="0 0 24 24"
												fill="none"
												stroke="currentColor"
												stroke-width="2"
												stroke-linecap="round"
												stroke-linejoin="round">
												<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
												<polyline points="16 17 21 12 16 7"></polyline>
												<line x1="21" y1="12" x2="9" y2="12"></line>
											</svg>
											<span class="ms-2">Logout </span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- Header end -->

			<!-- Sidebar start -->
			<div class="deznav">
				<div class="deznav-scroll">
					<ul class="metismenu" id="menu">
						<li>
							<a class="ai-icon" href="/" aria-expanded="false">
								<i class="fas fa-tachometer-alt"></i>
								<span class="nav-text">Dashboard</span>
							</a>
						</li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                                <i class="flaticon-381-network mr-0"></i>
                                <span class="nav-text">Mater</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="pelanggan">Pelanggan</a></li>
                                <li><a href="#">Kelompok Menu</a></li>
                                <li><a href="#">Kategori Menu</a></li>
                                <li><a href="#">Menu</a></li>
                            </ul>
                        </li>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
								<i class="flaticon-381-notepad mr-0"></i>
								<span class="nav-text">Transaksi</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="#">Penjualan</a></li>
								<li><a href="#">Piutang Pelanggan</a></li>
								<li><a href="#">Mutasi Kas</a></li>
							</ul>
						</li>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
								<i class="fa-regular fa-gear font-bold mr-0"></i>
								<span class="nav-text">Setup</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="#">Pajak</a></li>
								<li><a href="#">Format Struk</a></li>
								<li><a href="#">Diskon Menu</a></li>
							</ul>
						</li>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
								<i class="fa-regular fa-file-alt font-bold mr-0"></i>
								<span class="nav-text">Laporan</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="#">Penjualan Harian</a></li>
								<li><a href="#">Per Shift</a></li>
								<li><a href="#">Per Tipe Pembayaran</a></li>
								<li><a href="#">Margin Penjualan</a></li>
								<li><a href="#">Laba Rugi Harian</a></li>
								<li><a href="#">Closing Shift</a></li>
								<li><a href="#">All Rank Penjualan</a></li>
							</ul>
						</li>
                        <li>
                            <a class="ai-icon" href="javascript:void(0)">
                                <i class="fa-regular fa-user font-bold mr-0"></i>
                                <span class="nav-text">User</span>
                            </a>
                        </li>
                        <li>
                            <a class="ai-icon truncate" href="javascript:void(0)">
                                <i class="fa-regular fa-trash font-bold mr-0"></i>
                                <span class="nav-text truncate">Histori Data Terhapus</span>
                            </a>
                        </li>
					</ul>
				</div>
			</div>
			<!-- Sidebar end -->

			<!-- Content body start -->
			<div class="content-body" style="min-height: 1040px;">
				<div class="container-fluid">
					@stack("breadcumb")
                    @yield('content')
                </div>
			</div>

			<!-- Content body end -->

			<!-- Footer start -->
			<div class="footer mt-4 text-[13px] font-normal bg-card">
				<div class="copyright p-[0.9375rem]">
					<p class="text-center text-[#918f8f] dark:text-white sm:text-sm text-xs leading-[1.8]">
						Copyright © Designed & Developed by <a href="#" target="_blank" class="text-primary dark:hover:text-white">Software</a> 2024
					</p>
				</div>
			</div>
		</div>

		<script src="{{ asset('assets/vendor/global/global.min.js')}}"></script>
		<!-- Alpine js -->
		<script defer src="{{ asset('assets/vendor/alpine/alpineplugin.js')}}"></script>
		<script defer src="{{ asset('assets/vendor/alpine/alpine.js')}}"></script>
		<script src="{{ asset('assets/vendor/niceselect/js/jquery.nice-select.min.js')}}"></script>
		<!-- nice-select -->
		<script src="{{ asset('assets/js/deznav-init.js')}}"></script>
		<script src="{{ asset('assets/js/custom.js')}}"></script>
		<script src="{{ asset('assets/js/styleSwitcher.js')}}"></script>
		<script src="{{ asset('assets/js/demo.js')}}"></script>
		<!-- Toastr -->
		<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>

		<!-- All init script -->
		<script src="{{asset('assets/js/plugins-init/toastr-init.js')}}"></script>    
		<script src="{{asset('assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
		<script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/vendor/datatables/responsive/responsive.js')}}"></script>
		<script src="{{asset('assets/js/plugins-init/datatables.init.js')}}"></script>
		<script>
			document.addEventListener('alpine:init', () => {
            Alpine.store('common', {
                loadings: [],
                datas: [],
                loading: false,
                activeTab: 'tab-table',
                toastVisible: false,
                toastType: 'info',
                toastMessage: '-',
                toastShow(type, message) {
                    this.toastVisible = true;
                    this.toastMessage = message;
                    this.toastType = type;
                    setTimeout(() => {
                        this.toastVisible = false;
                    }, 5000);
                },
                reloadComponent(id) {
                    const component = document.getElementById(id);
                    if (component) {
                        component.dispatchEvent(new CustomEvent('reload-component', { bubbles: true }));
                    }
                },
            });
        });
		</script>
        @stack('scripts')
	</body>
</html>

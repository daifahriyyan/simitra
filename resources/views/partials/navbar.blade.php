<!-- header -->
<div class="top-header-area" id="sticker">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 text-center">
				<div class="main-menu-wrap">
					<!-- logo -->
					<div class="site-logo">
						<a href="index.html">
							<img src="assets/img/logo.png" alt="">
						</a>
					</div>
					<!-- logo -->

					<!-- menu start -->
					<nav class="main-menu">
						<ul>
							<li><a href="/home">Home</a></li>
							<li><a href="/contact">Contact</a></li>
							@auth
							<li><a href="/daftar-order">Order</a></li>
							@endauth
							<li>
								<div class="header-icons">
							<li><a class="account" href="{{ route('Profile') }}"><i class="fas fa-user"></i></a>
								<ul class="sub-menu">
									@guest
									<li><a href="{{ route('Register') }}">Register</a></li>
									<li><a href="{{ route('Login') }}">Login</a></li>
									@endguest
									<form action="{{ route('Logout') }}" method="post">
										@csrf
										<li><button type="submit" class="bg-transparent border-0 p-0"><a>Logout</a></button></li>
									</form>
								</ul>
							</li>
				</div>
				</li>
				</ul>
				</nav>
				<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
				<div class="mobile-menu"></div>
				<!-- menu end -->

			</div>
		</div>
	</div>
</div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<span class="close-btn"><i class="fas fa-window-close"></i></span>
				<div class="search-bar">
					<div class="search-bar-tablecell">
						<h3>Search For:</h3>
						<input type="text" placeholder="Keywords">
						<button type="submit">Search <i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end search area -->
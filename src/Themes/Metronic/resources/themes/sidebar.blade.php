				<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<div class="page-sidebar navbar-collapse collapse">
					<!-- BEGIN SIDEBAR MENU -->
					<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
					<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
					<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
					<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
					<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
					<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
					<ul class="page-sidebar-menu page-sidebar-menu-closed page-sidebar-menu-light  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="50" style="padding-top: 20px">
						<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
						<li class="sidebar-toggler-wrapper hide">
							<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
							<div class="sidebar-toggler">
								<span></span>
							</div>
							<!-- END SIDEBAR TOGGLER BUTTON -->
						</li>
						<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
						<!-- <li class="sidebar-search-wrapper"> -->
							<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
							<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
							<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
							<!-- <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST"> -->
								<!-- <a href="javascript:;" class="remove"> -->
									<!-- <i class="icon-close"></i> -->
								<!-- </a> -->
								<!-- <div class="input-group"> -->
									<!-- <input type="text" class="form-control" placeholder="Search..."> -->
									<!-- <span class="input-group-btn"> -->
										<!-- <a href="javascript:;" class="btn submit"> -->
											<!-- <i class="icon-magnifier"></i> -->
										<!-- </a> -->
									<!-- </span> -->
								<!-- </div> -->
							<!-- </form> -->
							<!-- END RESPONSIVE QUICK SEARCH FORM -->
						<!-- </li> -->
						<li class="nav-item start @if(isset($theme['first']) and $theme['first'] == 'manufacturing') active @endif">
							<a href="javascript:;" class="nav-link nav-toggle">
								<i class="fa fa-industry"></i>
								<span class="title">İmalat</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'company') active @endif">
									<a href="{{route('productionOrders')}}" class="nav-link ">
										<span class="title">İmalat</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'order') active @endif"">
									<a href="{{route('operationsOfManufacturing')}}" class="nav-link ">
										<span class="title">Operasyonlar</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'order') active @endif"">
									<a href="{{route('centersOfManufacturing')}}" class="nav-link ">
										<span class="title">İş İstasyonları</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item @if(isset($theme['first']) and $theme['first'] == 'crm') active @endif">
							<a href="javascript:;" class="nav-link nav-toggle">
								<i class="fa fa-opencart"></i>
								<span class="title">CRM</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'company') active @endif">
									<a href="{{route('companies')}}" class="nav-link ">
										<span class="title">Müşteriler</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'order') active @endif"">
									<a href="{{route('orders')}}" class="nav-link ">
										<span class="title">Siparişler</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item  @if(isset($theme['first']) and $theme['first'] == 'inventory') active @endif">
							<a href="javascript:;" class="nav-link nav-toggle">
								<i class="fa fa-th"></i>
								<span class="title">Depo</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'lots') active @endif">
									<a href="{{route('lots')}}" class="nav-link ">
										<span class="title">Lotlar</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'inventory') active @endif">
									<a href="{{route('inventory')}}" class="nav-link ">
										<span class="title">Depo</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item @if(isset($theme['first']) and $theme['first'] == 'production') active @endif">
							<a href="javascript:;" class="nav-link nav-toggle">
								<i class="fa fa-bolt"></i>
								<span class="title">Üretim Yapılandırma</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'part') active @endif">
									<a href="{{route('parts')}}" class="nav-link ">
										<span class="title">Parçalar</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'bom') active @endif"">
									<a href="{{route('boms')}}" class="nav-link ">
										<span class="title">Ürün Ağaçları</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'rotation') active @endif">
									<a href="{{route('routes')}}" class="nav-link ">
										<span class="title">Rotasyonlar</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'operation') active @endif">
									<a href="{{route('workTypes')}}" class="nav-link ">
										<span class="title">Operasyonlar</span>
									</a>
								</li>
								<li class="nav-item @if(isset($theme['second']) and $theme['second'] == 'station') active @endif">
									<a href="{{route('workCenters')}}" class="nav-link ">
										<span class="title">İş İstasyonları</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item last">
							<a data-toggle="modal" href="#fast" class="nav-link nav-toggle">
								<i class="fa fa-star"></i>
								<span class="title">Hızlı Git</span>
								<span class="arrow"></span>
							</a>
						</li>
					</ul>
					<!-- END SIDEBAR MENU -->
					<!-- END SIDEBAR MENU -->
				</div>
		   <!-- END SIDEBAR -->
			</div>

					<div id="fast" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">'.$title.'</h4>
								</div>
								<div class="modal-body">
									<p>
										{{Form::open(['route'=>'goFast'])}}
											{{Form::text('key', null, ['class' => 'form-control'])}}
											{{Form::submit('Git', ['class'=>'form-control'])}}
										{{Form::close()}}
									</p>
								</div>
								<div class="modal-footer">
									<button type="button" data-dismiss="modal" class="btn default">İptal</button>
									<a href="'.route($route, $routeDetail).'" class="btn blue-hoki">Sil</a>
								</div>
							</div>
						</div>
					</div>
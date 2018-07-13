<div class="topHeader">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<p id="topHeaderPara1">Merkuriusz - Techiniki nadruków Tarnów</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<p id="topHeaderPara2">siedziba firmy: Szpitalna 25B, 33-100 Tarnów</p>
			</div>
		</div>
	</div>
</div>
<div class="container" id="top-container">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-12 col-12  mb-sm-3 mb-3 mt-2 mt-sm-0">
			<a  href="<?php echo home_url(); ?>" title="Merkuriusz" class="logo-block">
			<img src="<?php echo get_template_directory_uri(); ?>/media/logo1.jpg" alt="Merkuriusz logo" id="logo" />
			</a>
		</div>
		<div class="col-lg-9 col-md-6 col-sm-12" id="top-container-search">
			<div class="row">
				<div class="col-lg-7 col-md-12 col-sm-12 mb-sm-3 mb-3">
					<form class="form-inline" method="get" id="search-small-outline">
						<div class="input-group justify-content-md-end justify-content-sm-center">
							<input type="text" class="query-small" placeholder="Wpisz nazwę lub kod produktu">
							<button type="submit" id="searchsubmit-small"> SKUKAJ &nbsp <img src="<?php echo get_template_directory_uri(); ?>/media/search.png" id="Searchimage"> </button> 
						</div>
					</form>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 mt-md-2 mt-lg-0">
					<div class=" contact-outline justify-content-sm-center" >
						<div id="contact-img"> 
							<img src="<?php echo get_template_directory_uri(); ?>/media/smartphone.png"> 
						</div>
						<div id="contact-content"> 
							<a href="" id="contact-number"> +48 14 622 33 64 </a> 
							<a href="" id="contact-email"> biuro@merkuriusz.pl</a> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--top header closed--> 
<div class="main-menu-section main-menu-block">
	<div class="container" >
		<div class="row">
			<div class="col-md-3 visible-xl">
			</div>
			<div class="col-md-12 col-lg-9 col-xl-9">
				<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top" id="navbar-container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>                                 
					<span  id="menuglowne"> Menu główne</span>
					<div class="collapse navbar-collapse" id="navbarResponsive">
						<ul class="navbar-nav mr-auto">
							<?php
								$menu = wp_get_nav_menu_items( 'menu-glowne' );
								$ID = get_post()->ID;
									
								foreach( $menu as $item ){
									/*
object(WP_Post)#3703 (37) {
	["ID"]=>
	int(31)
	["post_author"]=>
	string(1) "1"
	["post_date"]=>
	string(19) "2018-07-13 11:36:29"
	["post_date_gmt"]=>
	string(19) "2018-07-13 09:36:29"
	["post_content"]=>
	string(1) " "
	["post_title"]=>
	string(0) ""
	["post_excerpt"]=>
	string(0) ""
	["post_status"]=>
	string(7) "publish"
	["comment_status"]=>
	string(6) "closed"
	["ping_status"]=>
	string(6) "closed"
	["post_password"]=>
	string(0) ""
	["post_name"]=>
	string(2) "31"
	["to_ping"]=>
	string(0) ""
	["pinged"]=>
	string(0) ""
	["post_modified"]=>
	string(19) "2018-07-13 11:56:29"
	["post_modified_gmt"]=>
	string(19) "2018-07-13 09:56:29"
	["post_content_filtered"]=>
	string(0) ""
	["post_parent"]=>
	int(0)
	["guid"]=>
	string(34) "http://merkuriusz.scepter.pl/?p=31"
	["menu_order"]=>
	int(1)
	["post_type"]=>
	string(13) "nav_menu_item"
	["post_mime_type"]=>
	string(0) ""
	["comment_count"]=>
	string(1) "0"
	["filter"]=>
	string(3) "raw"
	["db_id"]=>
	int(31)
	["menu_item_parent"]=>
	string(1) "0"
	["object_id"]=>
	string(1) "5"
	["object"]=>
	string(4) "page"
	["type"]=>
	string(9) "post_type"
	["type_label"]=>
	string(6) "Strona"
	["url"]=>
	string(29) "http://merkuriusz.scepter.pl/"
	["title"]=>
	string(15) "Strona główna"
	["target"]=>
	string(0) ""
	["attr_title"]=>
	string(0) ""
	["description"]=>
	string(0) ""
	["classes"]=>
	array(1) {
	  [0]=>
	  string(0) ""
	}
	["xfn"]=>
	string(0) ""
}
									*/
									printf(
										'<li class="nav-item %s">
											<a class="nav-link" href="%s">
												%s
											</a>
										</li>',
										$ID === $item->ID?('active'):(''),
										$item->url,
										mb_strtoupper( $item->title )
										
									);
									
								}
							?>
						</ul>
						<a class="ml-auto search- d-flex">
						<i class=" ion-ios-search-strong"></i>
						</a>
					</div>
				</nav>
				<!-- end of the NAV-->  
			</div>
		</div>
	</div>
</div>
<!--===================================end of the main-menu-section===========================================================-->
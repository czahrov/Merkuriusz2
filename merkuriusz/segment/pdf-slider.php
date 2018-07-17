<?php
	$pdf_cat = get_pages( array(
		'parent' => get_page_by_path('specjalne/slider-pdf')->ID,
		
	) );
?>
<div class="container category-blocks">
	<div class="row">
		<div id="category-item-slider">
			<?php foreach( $pdf_cat as $single ): ?>
			<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
				<?php
					$single_pdf = wp_get_attachment_url( get_post_meta( $single->ID, 'pdf', true ) );
					if( $single_pdf !== false ):
				?>
				<a class='hitbox' href='<?php echo $single_pdf; ?>' target='_blank'></a>
				<?php endif; ?>
				<div class="item inner each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
					<div class="category-inner-content">
						<div class="category-blocks-img">
							<img class="img-responsive" src="<?php echo wp_get_attachment_image_url( get_post_meta( $single->ID, 'grafika', true ), 'large' ); ?>" alt=""/>
						</div>
						<div id="absoluteborder">
							<?php
								$parts = explode( ' ', $single->post_title );
							?>
							<div class="watchtext1">
								<?php echo array_splice( $parts, 0, 1 )[0]; ?>
							</div>
							<div class="watchtext2">
								<?php echo implode( " ", $parts ); ?>
							</div>
							<div class="arrow-circle1">
								<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-lg-12 fifth-container text-center" style="margin-top:40px;">
		<div class="arrow-circle prev"> <img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png"></div>
		<div class="arrow-circle next"> <img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png"></div>
	</div>
	<div id='pdf-popup' class='d-flex align-items-center justify-content-center'>
		<div class='box'>
			<div class='exit d-flex align-items-center justify-content-center'>
				X
			</div>
			<div class='view'>
				<?php foreach( $pdf_cat as $cat ): ?>
				<div class='page d-flex'>
					<div class='img' style='background-image:url(<?php echo wp_get_attachment_image_url( get_post_meta( $cat->ID, 'grafika', true ), 'large' ); ?>);'></div>
					<div class='list d-flex flex-column'>
						<?php
							$pdf_subcat = get_pages( array(
								'parent' => $cat->ID,
							) );
							foreach( $pdf_subcat as $subcat ):
							$sub_img = wp_get_attachment_image_url( get_post_meta( $subcat->ID, 'grafika', true ), 'large' );
						?>
						<a class='item d-flex align-items-center justify-content-center' href="<?php echo wp_get_attachment_url( get_post_meta( $subcat->ID, 'pdf', true ) ); ?>" target='_blank'>
							<?php if( $sub_img !== false ): ?>
							<div class='img' style='background-image:url(<?php echo $sub_img; ?>);' alt='<?php echo $subcat->post_title; ?>'></div>
							<?php else: ?>
							<?php echo $subcat->post_title; ?>
							<?php endif; ?>
						</a>
						<?php endforeach; ?>
					</div>
					
				</div>
				<?php endforeach; ?>
			</div>
			
		</div>
		
	</div>
	
</div>
<!-- ======================end of the category block container ==================-->

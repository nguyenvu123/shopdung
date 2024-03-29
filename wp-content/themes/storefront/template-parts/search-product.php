<?php 
global $post; 

	$key =  $_GET['key'];
	$filter =  $_GET['filter'];
	$paged =  $_GET['paged'];
	$args = array(

		'post_type' => 'product',
		'posts_per_page' => 16,
		'type' => 'NUMERIC',
		'paged'  => $paged,
			'meta_query' => array(
		        array(
		            'key' => '_stock_status',
		            'value' => 'instock'
		        ),
		        array(
		            'key' => '_backorders',
		            'value' => 'no'
		        ),
		    )
		);
		if($key) {
			$args  = array('s' => $key);
		}

		if($filter) {

			$args['tax_query'] = array(
		        array (
		            'taxonomy' => 'product_cat',
		            'field' => 'slug',
		            'terms' => $filter
		        )
		    );
		}

	
		$loop = new WP_Query( $args );
		if($loop->post_count ==0) {
			echo 'Không có kết quả nào phù hợp với kết quả tìm kiếm của bạn !';
		}
		?>
		

		<?php
		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
			global $product; 
			$terms = get_the_terms( $post->ID, 'product_cat' );

			
			?>

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= $terms[0]->slug ?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0 label-new" data-label="New">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/product-01.jpg" alt="IMG-PRODUCT">

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id='<?=$post->ID ?>' >
								CHI TIẾT
							</a>


						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?=$product->name;?> 

								</a>
								
									
							
								<?php if ( $product->is_on_sale() ) { ?> 
								<div class="price">
									<span class="regular_price"><?= number_format($product->get_regular_price()); ?> đ</span>
									<span class="sale"><?= number_format($product->get_sale_price()); ?> đ</span>
								</div>
								<?php }else { ?>

								<span class="stext-105 cl3">
									<?= number_format($product->get_regular_price()) ?>đ
								</span>
							<?php } ?>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="<?php echo get_template_directory_uri(); ?>/assets/icon-heart1 dis-block trans-04" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-heart-01.png" alt="ICON">
									<img class="<?php echo get_template_directory_uri(); ?>/assets/icon-heart2 dis-block trans-04 ab-t-l" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>

			 <?php
			endwhile;
			wp_reset_postdata();
    		wp_reset_query();
		endif;
	
?>

<div class="navigation ajax flex-c-m flex-w w-full p-t-38" data-paged="<?= $paged ?>"><?php wp_pagenavi( array( 'query' => $loop ) ); ?></div>

<?php
if ( ! defined( 'ABSPATH' ) ) {	exit;}$user_id  = get_current_user_id();$my_auctions = get_woo_ua_auction_by_user($user_id);?><table class="shop_table shop_table_responsive">    <tr>        <th class="toptable"><?php echo __( 'Image', 'woo_ua' ); ?></td>        <th class="toptable"><?php echo __( 'Product', 'woo_ua' ); ?></td>        <th class="toptable"><?php echo __( 'Your bid', 'woo_ua' ); ?></td>        <th class="toptable"><?php echo __( 'Current bid', 'woo_ua' ); ?></td>        <th class="toptable"><?php echo __( 'Status', 'woo_ua' ); ?></td>    </tr>    <?php    foreach ( $my_auctions as $my_auction ) {        $product      = wc_get_product( $my_auction->auction_id );        if ( !$product )            continue;                $product_name = get_the_title( $my_auction->auction_id );        $product_url  = get_the_permalink( $my_auction->auction_id );        $a            = $product->get_image( 'thumbnail' );        ?>        <tr>            <td><?php echo $a ?></td>            <td><a href="<?php echo $product_url; ?>"><?php echo $product_name ?></a></td>            <td><?php echo wc_price( $my_auction->max_bid ) ?></td>            <td><?php echo $product->get_price_html(); ?></td>            <?php			if (($user_id == $product->get_woo_ua_auction_current_bider() && $product->get_woo_ua_auction_closed() == '2' && !$product->get_woo_ua_auction_payed() )) {             ?>				<td><a href="<?php echo apply_filters( 'woo_ua_auction_pay_now_button',esc_attr(add_query_arg("pay-woo-auction",$product->get_id(), woo_ua_auction_get_checkout_url()))); ?>" class="button alt"><?php _e('Pay Now', 'woo_ua') ?></a></td>            <?php  } elseif ( $product->is_woo_ua_closed() ){ ?> 							<td><?php echo __( 'Closed', 'woo_ua' ); ?></td>   				<?php } else { ?>                <td><?php echo __( 'Started', 'woo_ua' ); ?></td>                <?php            }            ?>		        </tr>        <?php    }    ?></table>
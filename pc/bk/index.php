<?php get_header(); ?>
<div class="main_v">
  <ul class="slider">
    <li><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/main_v.png" alt="滋賀県近江八幡で30年　どこよりも丁寧にどこよりも満足できる塗装工事をお約束します！" width="960" height="455"></li>
    <li><a href="<?php echo home_url();?>/shindan"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/slide/slide_shindan.jpg" alt="無料診断受付中" width="960" height="455"></a></li>
    <li><a href="<?php echo home_url();?>/hyosyo"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/slide/slide_hyosyo.jpg" alt="実績が信頼の証" width="960" height="455"></a></li>
  </ul>
</div>

<!--<div class="oshirase">
<strong>◆◇◆◇　夏季休暇のご案内　◆◇◆◇</strong><br />
誠に勝手ながら、2018年8月11日（土）～ 2018年8月15日（水）は休業させていただきます。<br />
通常営業は、8月16日（木）からとなります。<br />
休暇中にいただいたお問い合わせについては、通常営業日より順次対応させていただきますので、ご了承ください。<br />
今後も変わらぬご愛顧をどうぞよろしくお願いいたします。
</div>-->

<div class="first_bnr">
    <a href="<?php bloginfo('url'); ?>/riyu#h3_01"><img src="<?php echo get_template_directory_uri(); ?>/images/common/01_riyu_bnr.jpg" alt="お客様満足度をとことん追求" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_02"><img src="<?php echo get_template_directory_uri(); ?>/images/common/02_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_03"><img src="<?php echo get_template_directory_uri(); ?>/images/common/03_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_04"><img src="<?php echo get_template_directory_uri(); ?>/images/common/04_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_05"><img src="<?php echo get_template_directory_uri(); ?>/images/common/05_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_06"><img src="<?php echo get_template_directory_uri(); ?>/images/common/06_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_07"><img src="<?php echo get_template_directory_uri(); ?>/images/common/07_riyu_bnr.jpg" alt="" width="215" height="201"></a>
    <a href="<?php bloginfo('url'); ?>/riyu#h3_08"><img src="<?php echo get_template_directory_uri(); ?>/images/common/08_riyu_bnr.jpg" alt="" width="215" height="201"></a>
</div>

<p class="top_bnr"><img src="<?php echo get_template_directory_uri(); ?>/images/common/tel_bnr.png" alt="外装リフォームを熟知した専門スタッフがたくさん <?php the_field('comtel-', 'Options'); ?>" width="960" height="190"></p>
<div class="main_wrapper">
  <main class="main_contents">

    <p class="top_bnr"><a href="<?php bloginfo('url'); ?>/riyu"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/riyu_bnr.png" alt="<?php the_field('comname',  'Options'); ?>が他店よりも選ばれる理由" width="690" height="240" class="img_over"></a><br />
　  <a href="<?php bloginfo('url'); ?>/tantou"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/tantou_bnr.png" alt="専任担当者制" width="690" height="277" class="img_over"></a></p>
    <!--==============	  お客様の声-->
    <section class="top_voice top_sec">
      <h2 class="sec_tit"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/voice_tit.png" alt="お客様の声" width="690" height="46"></h2>
      <?php $args = array(
	'post_type' => 'voice', /* 投稿タイプ */
	'paged' => $paged,
	'posts_per_page' => 3 /* 件数表示 */
	);
		query_posts( $args );?>


      <div class="voice_archive">
	      <?if (have_posts()) :$i = 0;$x = 0; ?>
      <ul class="inner">
<?php while( have_posts() ) : the_post(); ?>
        <li><a href="<?php bloginfo('url'); ?>/voice#id<?php echo get_the_ID(); ?>"><span class="pic"><span class="pic_inner"><?php
							printf(
								gr_get_image(
								'mainpic',
								array( 'width' => 350, 'alt' => esc_attr( get_the_title() ),'class'=>'img_over'  )
							)
						); ?></span></span> <span class="text"><?php echo get_the_title(); ?><br>
          <?php
    $pattern = '/(^.{10})(.+)/u';
    $subject = get_field( 'staffcomment' );
    $matches = array();
    preg_match($pattern, $subject , $matches);
    if ($matches[2] != '') {
        $out = $matches[1] . '...';
    } else {
        $out = $subject;
    }
    echo($out);
?></span><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/voice_tape.png" alt="テープ" class="tape"></a></li>
<?php $i++;endwhile;
	 ?>
      </ul>
      <? else :?>
      <p class="no_data">只今準備中</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
      </div>
      <p class="more"><a href="<?php bloginfo('url'); ?>/voice"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/voice_more_off.png" alt="お客様の声をもっと見る" width="330" height="51"></a></p>
    </section>
    <p class="top_bnr"><a href="<?php bloginfo('url'); ?>/staff"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/staff_bnr_off.png" alt="スタッフ紹介" width="690" height="240"></a></p>
    <?php echo do_shortcode('[contact_bnr]'); ?>
    <section class="top_seko top_sec">
      <h2 class="sec_tit"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/seko_tit.png" alt="施工事例" width="690" height="57"></h2>
      <?php echo do_shortcode('[seko_archive kensu=9]'); ?>
      <p class="more"><a href="/seko"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/seko_more_off.png" alt="施工事例をもっと見る" width="330" height="51"></a></p>
    </section>

<!--==============	  スタッフブログ-->
<section class="top_blog top_sec">
<div class="blog_area">
<h2 class="sec_tit"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/blog_tit.png" alt="スタッフブログ" width="690" height="136"></h2>
<br clear="all">
<?php //JJFスタッフ
include_once(ABSPATH . WPINC . '/feed.php');
$rss = fetch_feed('http://jjfjjf.shiga-saku.net/index.rdf');
if (!is_wp_error( $rss ) ) {
    // 取得件数　最新
    $maxitems = $rss->get_item_quantity(1);
    $rss_items = $rss->get_items(0, $maxitems);
}?>
<div class="blog_box jjf_blog">
<img src="<?php echo get_template_directory_uri(); ?>/page_image/top/blog_tit01.png" width="230" alt="JJFスタッフBLOG">
<div class="blog_parts">
<div class="jjf_blog_pic">
    <a href="http://jjfjjf.shiga-saku.net/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/jjf_blog_pic_bg.png"  alt="JJFスタッフ" width="220" /></a>
</div><!--/.blog_pic-->
<?php if ( !empty( $maxitems ) ) {
        foreach ( $rss_items as $item ) {?>
<div class="blog_txt">
  <p class="blog_tit"><a href="<?php echo $item->get_permalink(); ?>" target="_blank"><?php echo $item->get_title(); ?></a></p>
  <p class="blog_date"><?php echo $item->get_date('Y.m.d'); ?></p>
</div><!--/.blog_txt-->
  <p class="blog_more_btn"><a href="http://jjfjjf.shiga-saku.net/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/blog_more_btn01.png" width="135" alt="もっとみる"></a></p>
<?php }} ?>
  </div><!--/.blog_parts-->
</div><!--blog_box-->

<?php //外壁塗装BLOG
	$args = array(
	'post_type' => 'blog', /* 投稿タイプ */
	'posts_per_page' => 2,		/* 件数 */
);
$myposts = get_posts( $args );
?>

<div class="blog_box gaiheki_box">
<img src="<?php echo get_template_directory_uri(); ?>/page_image/top/blog_tit02.png" width="460" alt="外壁塗装BLOG">
<div class="clearfix">
<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
<div class="blog_parts">
  <div class="blog_pic">
    <a href="<?php the_permalink(); ?>"><img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>"></a>
  </div><!--/.blog_pic-->
  <div class="blog_txt">
    <p class="blog_tit"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
    <p class="blog_date"><?php the_time('Y.n.j'); ?></p>
  </div><!--/.blog_txt-->
    <?php if(empty($post)){ ?>
    <p class="no_data">只今準備中</p>
    <?php } ?>
</div><!--/.blog_parts-->
<?php endforeach; wp_reset_postdata(); ?>
</div>
<p class="blog_more_btn"><a href="/blog"><img src="<?php echo get_template_directory_uri(); ?>/page_image/top/blog_more_btn02.png" width="135" alt="もっとみる"></a></p>
</div><!--/.blog_box-->


</div><!--/.blog_area-->
</section>

    <?php echo do_shortcode('[contact_bnr]'); ?>
  </main>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

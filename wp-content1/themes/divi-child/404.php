<?php get_header(); ?>

<div id="main-content">
	<div class="container">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/1_404.jpg" alt="" width="" height="" />
		<div class="404btn"  style="text-align: center;margin-bottom: 100px;font-size: 22px;">
			<a style="color: #fff;background: #000;padding: 10px 25px;border-radius: 26px;" href="http://garcon-group.createmywordpress.com/"> Back to homepage </a>
		</div>
	</div> <!-- .container -->
</div> <!-- #main-content -->
<style>
@media (min-width: 981px){
#main-content .container:before {
    position: absolute;
    top: 0;
    width: 1px;
    height: 100%;
    background-color: transparent!important;
    content: "";
}
}

</style>
<?php

get_footer();


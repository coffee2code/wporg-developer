</div> <!-- /#wrapper -->

<div id="wporg-footer">
	<div class="wrapper">
		<ul>
			<li><a href="http://wordpress.org/about/" title="An introduction to the WordPress project">About</a></li>
			<li><a href="http://wordpress.org/news/" title="News and Updates">Blog</a></li>
			<li><a href="http://wordpress.org/hosting/" title="Recommended web hosting providers">Hosting</a></li>
			<li><a href="http://jobs.wordpress.net/" title="Find or post WordPress jobs">Jobs</a></li>
		</ul>

		<ul>
			<li><a href="http://wordpress.org/support/" title="Forums, documentation, and other resources">Support</a></li>
						<li><a href="http://make.wordpress.org/" title="Give back to WordPress through code, support, translation and more">Get Involved</a></li>
			<li><a href="http://learn.wordpress.org/" title="Workshops and training materials">Learn</a></li>
		</ul>

		<ul>
			<li><a href="http://wordpress.org/showcase/" title="Some of the best WordPress sites on the Web">Showcase</a></li>
			<li><a href="http://wordpress.org/plugins/" title="Add extra functionality to WordPress">Plugins</a></li>
			<li><a href="http://wordpress.org/themes/" title="Make your WordPress pretty">Themes</a></li>
			<li><a href="http://wordpress.org/ideas/" title="Share your ideas for improving WordPress">Ideas</a></li>
		</ul>

		<ul>
			<li><a href="http://central.wordcamp.org/" title="Find a WordPress event near you">WordCamp</a></li>
			<li><a href="http://wordpress.tv/" title="Videos, tutorials, and WordCamp sessions">WordPress.TV</a></li>
			<li><a href="http://buddypress.org/" title="A set of plugins to transform your WordPress into a social network">BuddyPress</a></li>
			<li><a href="http://bbpress.org/" title="Fast, slick forums built on WordPress">bbPress</a></li>
		</ul>

		<ul>
			<li><a href="http://wordpress.com/?ref=wporg-footer" title="Hassle-free WordPress hosting">WordPress.com</a></li>
			<li><a href="http://ma.tt/" title="Co-founder of WordPress, an example of what WordPress can do">Matt</a></li>
			<li><a href="http://wordpress.org/about/privacy/" title="WordPress.org Privacy Policy">Privacy</a></li>
			<li><a href="http://wordpress.org/about/license/" title="WordPress is open source software">License / GPLv2</a></li>
		</ul>

		<ul>
			<li>
				<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name=WordPress&show_count=false" style="width:135px; height:20px;"></iframe>
			</li>
			<li>
				<iframe src="//www.facebook.com/plugins/like.php?app_id=121415197926116&amp;href=http%3A%2F%2Fwww.facebook.com%2Fwordpress&amp;send=false&amp;layout=button_count&amp;width=135&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:135px; height:21px;" allowTransparency="true"></iframe>
			</li>
		</ul>
	</div>

	<h6 class="aligncenter">Code is Poetry</h6>
</div>

<script type="text/javascript">
(function($){
	$.ajax({
		url : '/lang-guess/lang-guess-ajax.php?uri=%2F',
		dataType: 'html'
	}).done(function(data) {
		if ( ! data ) return;
		$(document).ready( function() {
			$('#lang-guess-wrap').html(data);
		});
	});
})(jQuery);
</script>

<script type="text/javascript">_qoptions={qacct:"p-18-mFEk4J448M"};</script>
<script type="text/javascript" src="//edge.quantserve.com/quant.js"></script>
<noscript><img src="//pixel.quantserve.com/pixel/p-18-mFEk4J448M.gif" style="display: none;" border="0" height="1" width="1" alt=""/></noscript>
<!--  -->
<script type="text/javascript" src="//gravatar.com/js/gprofiles.js"></script>

<script type="text/javascript">
(function($){
$(document).ready(function() {
	$('#footer a').click(function() {
		if (this.href.indexOf('wordpress.org') == -1 && this.href.indexOf('http') == 0) {
			recordOutboundLink(this, 'Outbound Links', this.href);
			return false;
		}
	});
	$('#download a, a.download-button').click(function() {
		recordOutboundLink(this, 'Download Links', $(this).hasClass('download-button') ? 'button' : 'nav' );
		return false;
	});
});
})(jQuery);
</script>

<?php wp_footer(); ?>
</body>
</html>
<div id="bottomContainer" class="bottom-container" ondragstart="return false;">
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p class="footer-copyright"><?php echo TTi18n::getText('Copyright ©️2015 TimeTrex. All Rights Reserved') ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="overlay" class=""></div>
</body>
<script>
	initAnalytics();
	function initAnalytics() {
		/* jshint ignore:start */
		if ( APIGlobal.pre_login_data.analytics_enabled === true ) {
			(function( i, s, o, g, r, a, m ) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function() {
						(i[r].q = i[r].q || []).push( arguments );
					}, i[r].l = 1 * new Date();
				a = s.createElement( o ),
					m = s.getElementsByTagName( o )[0];
				a.async = 1;
				a.crossorigin = 1;
				a.src = g;
				m.parentNode.insertBefore( a, m );
			})( window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga' );
			//ga('set', 'sendHitTask', null); //disables sending hit data to Google. uncoment when debugging GA.

			ga( 'create', APIGlobal.pre_login_data.analytics_tracking_code, 'auto' );

			Global.setAnalyticDimensions();
			Global.sendAnalytics( "<?php echo $_SERVER['SCRIPT_NAME'] ?>" );
		}
		/* jshint ignore:end */
	}
</script>
</html>
<?php
Debug::writeToLog();
?>
<footer class="footer-section clear">
<?php
$query = "select * from footer where id='1'";
$socail = $db->select($query);
if($socail){
    while($result = $socail->fetch_assoc()){
?> 
		<p>&copy; <?php echo $result['note'].' '.date('Y');?></p>
<?php } } ?>
	</footer>
</div>	

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-xxxxxx', 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>

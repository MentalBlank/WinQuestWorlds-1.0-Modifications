    <div id="left-sidebar">
        <?php
			$time = date("g:i A");
			echo "It is now <strong>$time</strong><br />";
			if(isset($_SESSION['name'])){
				$name = $_SESSION['name'];
				echo "<a href='../index.php'>Go Home</a>";
				echo "<br /><a href='../char.php'>Edit your info!</a>";
				echo "<br /><a href='../news.php'>Check the news!</a>";
				echo "<br /><a href='wqw/index.php'>Play WQW</a>";
				echo "<br /><br /><a href='../logout.php'>Logout [ $name ]</a>";
				if(isset($_SESSION['adm'])) {
				echo "<br /><br /><a href='../adm'>Admin Panel</a>";
				echo "<br /><a href='../adm/write.php'>Write some news</a>";
				echo "<br /><a href='../adm/delete.php'>Delete bad news</a>";
				echo "<br /><a href='../adm/uploadfile.php'>Upload SWF</a>";
				}
			} else {
				echo "<a href='../index.php'>Go Home</a>";
				echo "<br /><a href='../login.php'>Login and play!</a>";
				echo "<br /><a href='../wqw/signup.php'>Create an account!</a>";
				echo "<br /><a href='../news.php'>Check the news!</a>";
			}
		?>
		
		<br /><br />
		<script type="text/javascript"><!--
			google_ad_client = "pub-3265099106149937";
			/* 120x600, created 5/28/10 */
			google_ad_slot = "2055736788";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>

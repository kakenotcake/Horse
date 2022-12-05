<?php
/*
 * Copyright 2015 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

	session_start();
	session_cache_expire(30);
?>
<html>
	<head>
		<title>
			About
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<p><strong>Background</strong><br /><br />

				Central Virginia Horse Rescue, Inc   is a 501(c)3 small  rescue founded in south central Virginia and 
				dedicated to the care and rehabilitation of needy horses.  In 2020, the Horse Adoption Central moved to 
				Fredericksburg, VA.  The rescue serves the state of Virginia.

				<p>Our mission is to save, protect, and rehabilitate equines in need.  We rescue unwanted, abused, neglected, 
				or abandoned equines; provide them with care and rehabilitation; and finally find them a compatible, loving home.  
				We believe that education is the long-term solution to improving the lives of equines.

				<p> For more information, please visit our <a href="http://https://centralvahorserescue.org/">website</a>.</p>
				
			</div>
		<?PHP include('footer.inc');?>
		</div>
	</body>
</html>

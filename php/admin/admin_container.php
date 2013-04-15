<?php

	include '../getConnection.php';

?>

<div class="row-fluid">
	<div class="span4">
		<h3 class="boostro" data-bootstro-content="yupyupyup"><h3>Manage All Users!</h3>
		<p>Create, Edit and Delete all the users!</p>
		<a href='all_Accounts.php' class="btn btn-primary" rel="popover" data-original-title="All Users">All Users</a>
	</div>
	<div class="span4">
		<h3 class="bootstro" data-bootstro-title="intro" data-bootstro-content="yupyupyup">See All Subjects!</h3>
		<p>Check out these subjects and fix 'em!</p>
		<a id="example" href="../subjects/all_Subjects.php" class="btn btn-primary" rel="popover" data-content="just testing on popovers" data-original-title="All Subjects">All Subjects</a>
	</div>
	<div class="span4">
		<h3>Create a token</h3>
		<p>Make a token for students to get access with their smart phones!</p>
		<a href="admin_CreateToken.php" class="btn btn-primary" rel="popover" data-original-title="Token">Token</a>
	</div>
</div>

<!--<a class="btn btn-large btn-success" href="#" id="bootstroTest">boostro test click me</a>-->
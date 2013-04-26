<?php

	include '../getConnection.php';

?>

<div class="row-fluid">
	<div class="span4 bootstro" data-bootstro-placement="bottom" data-bootstro-title="This is Accounts" data-bootstro-content="Click the link below to see account information. You're able to create, update and delete them.">
		<h3>Manage All Users!</h3>
		<p>Create, Edit and Delete all the users!</p>
		<!--<a href='all_Accounts.php'>All Users</a>-->
		<a href='#'>All Users</a>
	</div>
	<div class="span4 bootstro" data-bootstro-placement="bottom" data-bootstro-title="All the subjects" data-bootstro-content="Click on the link to see a list of all the subjects. You can edit, create and even delete them.">
		<h3>See All Subjects!</h3>
		<p>Check out these subjects and fix 'em!</p>
		<a href="../subjects/all_Subjects.php">All Subjects</a>
	</div>
	<div class="span4 bootstro" data-bootstro-placement="bottom" data-bootstro-title="Tokens for students" data-bootstro-content="You must create a token for students to register their account. Make sure to make a new one every semester!">
		<h3>Create a token</h3>
		<p>Make a token for students to get access with their smart phones!</p>
		<a href="admin_CreateToken.php">Token</a>
	</div>
</div>
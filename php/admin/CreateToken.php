
<?php
	include '../getConnection.php';
	require '../check_logged_in.php';
	require_once("../../DAL/DataAccessLayer.php");
	$settoken = 0;
	$token = "";
?>


<?php
	if (isset($_POST["submitNToken"])){
		if ($_POST["token"] == NULL)
	        $settoken = 1;
		else { $token = $_POST["token"];
			createToken($token);
		}
	}
?>
<div class="container">

	<form class="form-horizontal" method="post" action='<?php echo($_SERVER["PHP_SELF"]); ?>'>
		<div class="center">
			<fieldset>
				<div class="control-group bootstro" data-bootstro-placement="bottom" data-bootstro-title="The Token" data-bootstro-content="Enter a <b>token</b> in the textfield below.">
					<label class="control-label" for="token">Enter New Token: </label>
					<div class="controls">
						<input type="text" name="token" id="token" value="<?php echo($token); ?>" />
					</div>
				</div>

				<!-- Error message -->
				<?php if ($settoken) echo "<div class='errmsg'>Please enter a token!</div>"; ?>
				<div class="controls">
					<button class="btn bootstro" data-bootstro-placement="bottom" data-bootstro-title="Reset" data-bootstro-content="click this button to reset token back to <b>blank</b>." type="submit" name="reset" onClick="reset();">Reset</button>
					<button class="btn bootstro" data-bootstro-placement="bottom" data-bootstro-title="Submit" data-bootstro-content="Create the token by click submit." type="submit" name="submitNToken">Submit</button>
				</div>
			</fieldset>
		</div>
	</form>

</div>

<?php
	if (isset($POST["reset"])){
		$settoken = 0;
		$token = "";
	}
?>
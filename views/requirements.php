<?php defined('MW_INSTALLER_PATH') or exit();?>


<?php if($result > 0) { ?>
<div class="alert alert-success alert-block">
	Congratulations! Your server configuration satisfies all requirements by MailWizz EMA.
</div>
<?php } elseif($result < 0) { ?>
<div class="alert alert-warning alert-block">
	Your server configuration satisfies the minimum requirements by MailWizz EMA.<br />
	Please pay attention to the warnings listed below if your application will use the corresponding features.
</div>
<?php } else { ?>
<div class="alert alert-danger alert-block">
	Unfortunately your server configuration does not satisfy the requirements by MailWizz EMA.	
</div>
<?php } ?>

<form method="post">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Requirements</h3>
		</div>
		<div class="panel-body">
			
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<tr>
						<th>Name</th>
						<th>Result</th>
						<th>Required by</th>
						<th>Memo</th>
					</tr>
					<?php foreach($requirements as $requirement): ?>
					<tr>
						<td><?php echo $requirement[0]; ?></td>
						<td class="<?php echo $requirement[2] ? 'success' : ($requirement[1] ? 'danger' : 'warning'); ?>">
						<?php echo $requirement[2] ? 'Passed' : ($requirement[1] ? 'Failed' : 'Warning'); ?>
						</td>
						<td><?php echo $requirement[3]; ?></td>
						<td><?php echo $requirement[4]; ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			
		</div>
		<div class="panel-footer">		
		</div>
	</div>
</form>
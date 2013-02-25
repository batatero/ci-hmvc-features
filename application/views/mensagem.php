<?php if(isset($error['conteudo']) ):?>
	<div  class="alert alert-error" >
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php foreach($error['conteudo'] as $chaveError => $valorError):?>
			<?php if($valorError != ''): ?>
				<?php echo $valorError;?><br>
			<?php endif; ?>
		<?php endforeach;?>
	</div>
<?php endif;?>	

<?php if(isset($info['conteudo']) ):?>
	<div  class="alert alert-info" >
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php foreach($info['conteudo'] as $chaveInfo => $valorInfo):?>
			<?php if($valorInfo != ''): ?>
				<?php echo $valorInfo;?><br>
			<?php endif; ?>
		<?php endforeach;?>
	</div>
<?php endif;?>	

<?php if(isset($success['conteudo']) ):?>
	<div  class="alert alert alert-success" >
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php foreach($success['conteudo'] as $chaveSuccess => $valorSuccess):?>
			<?php if($valorSuccess != ''): ?>
				<?php echo $valorSuccess;?><br>
			<?php endif; ?>
		<?php endforeach;?>
	</div>
<?php endif;?>		


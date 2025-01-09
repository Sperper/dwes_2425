<!doctype html>
<html lang="es"> 

<?php require_once 'template/layouts/head.layout.php' ?>

<body>   
    <!-- Page Content -->
    <div class="container">
	<br><br><br><br>

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				ERROR
			</div>
			<div class="card-body">
				
                <p class="lead"><?php echo $this->mensaje ?></p>

			</div>
		</div>
    </div>
    <!-- /.container -->
    
    <?php require_once 'template/partials/footer.partial.php' ?>
	<?php require_once 'template/layouts/javascript.layout.php' ?>
	
</body>

</html>
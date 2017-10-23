<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>107J - Bierdatabase</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<?php
			require('beerdatabase.php');

			$bdb = new Beerdatabase();
			if(isset($_POST["brand"]))
			{
				$bdb-> addUser($_POST);
			}
		?>

		<section id="main">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form  method="post" id="searchform"> 
		    				<div class="input-group">
			      				<input name="search_input" type="text" class="form-control" placeholder="Zoeken naar...">
			      					<span class="input-group-btn">
			        					<button class="btn btn-primary" type="submit">Zoeken</button>
			      					</span>
			      					<select id="sel1" name="selected_user">
			      						<option value="select">Selecteer...</option>
			                            <?php foreach($bdb->getUsers() as $user) : ?>
			                                <option value="<?php echo $user[0] ?>"><?php echo $user[1] ?></option>
			                            <?php endforeach; ?>
		                          	</select>
		    				</div>
	    				</form>
	  				</div>
				</div>
				<a class="btn btn-primary mt-3" href="addBeer.php" role="button">Nieuwe invoer</a>

				<div class="row">
					<div class="col-lg-12">
						<?php $beers = $bdb->getBeers($bdb->getSearchInput(), $bdb->getSelectedUser()) ?>
						<?php foreach($beers as $beer) : ?>

							<div class="card mt-4">
								<div class="card-block">
									<h4 class="card-title"><?php echo $beer[1]; ?></h4>
									<h6 class="card-subtitle mb-2 text-muted"><?php echo $beer[2]; ?></h6>
									<span class="card-date"><?php echo $beer[5]; ?></span>
									<p class="card-text"><?php echo $beer[3]; ?></p>
									<p class=card-author><?php echo $bdb->getUser($beer[4]); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php if(empty($beers)) echo "Geen bierflesjes gevonden" ?>
			</div>
		</section>

	</body>
</html>

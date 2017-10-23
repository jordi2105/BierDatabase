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
        ?>

        <section id="main">
            <div class="container">
                <form class="form-horizontal" role="form" method="post" action="./" name="addBeerForm">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="brand" placeholder="Merk" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="type" placeholder="Type" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Beschrijving (optioneel)</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="sel1" class="col-sm-2 control-label">Naam drinker</label>
                       <div class="col-sm-10">
                          <select class="form-control" id="sel1" name="user">
                            <?php foreach($bdb->getUsers() as $user) : ?>
                                <option value="<?php echo $user[0] ?>"><?php echo $user[1] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Toevoegen</button>
                    </div>
                  </div>
                </form>
            </div>
        </section>

    </body>
</html>

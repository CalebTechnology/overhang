<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Your one-stop shop for all things Overhang">
    <meta name="author" content="MrCraftable">
    <link rel="shortcut icon" href="../favicon.ico?">
    <title>Add Product - Overhang - <?php echo $_SESSION['username']?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <?php require('../includes/session.php') ?>
    <?php
      // We need to use sessions, so you should always start sessions using the below code.
      #session_start();
      // If the user is not logged in redirect to the login page...
      if (!isset($_SESSION['loggedin'])) {
      	header('Location: ../login.php');
      	exit;
      }
      include('../includes/connect.php');
      $sql = "SELECT * FROM shops WHERE id = " . $_GET['id'];
      $result = $conn->query($sql);
      $row = $result->fetch();
      $shop_owner = $row['owner'];
      if($_SESSION['username'] != $shop_owner){
        header('Location: ../shops_activities.php');
        exit;
      }
    ?>
    <?php include('navbar_template.php') ?>
    <main>
      <br>
      <div class="container card">
        <?php echo '<form class="form-signin" action="new_product_sql.php?id=' . $_GET['id'] . '" method="post" enctype="multipart/form-data">' ?>
          <p style="font-size:1px">&nbsp;</p>
          <h1 class="h3 mb-3 font-weight-normal">Add Product:</h1>
          <div class='form-group'>
            <label for="product" class="sr-only">Product Name</label>
            <input type="text" name="product" id="product" class="form-control" placeholder="Product Name" required autofocus>
          </div>
          <div class='form-group'>
            <label for="price" class="sr-only">Price</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Price" required autofocus>
          </div>
          <div class="form-group">
            <h5>Product Image (optional):</h5>
            <label for="category">Category: (please note that mobs, animals, and NPCs category is a bit broken right now)</label>
            <select class="form-control" id="category" name="category" >
                <option value=""></option>
                <?php
                //Read in file
                $file = fopen('../minecraft-textures/categories.txt','r') or die('Cannot open file');
                while (!feof($file)) {
                  $line = fgets($file);
                  echo "<option value=\"" . trim($line) . "\">" . trim($line) . "</option>" . PHP_EOL;
                }
                ?>
              </select>
              <select class="form-control" id="product_texture" name="product_texture" >
                <option value="">--select category to find texture--</option>
                <!--The rest are filled in with JS based on previous selection-->
              </select>
              <img src='../minecraft-textures/empty.png' alt='product texture preview' id='preview' style='height:64px; width:auto; padding-top:0.75em'></img>

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

              <?php
              $building_material_files = new FilesystemIterator('../minecraft-textures/Building Materials');
              $utilities_files = new FilesystemIterator('../minecraft-textures/Crafting, Repairing, Smelting, and Storing');
              $creative_files = new FilesystemIterator('../minecraft-textures/Creative, Commands, and Education Edition');
              $natural_material_files = new FilesystemIterator('../minecraft-textures/Dirt, Grass, Gravel, Sand, and Stones');
              $dye_files = new FilesystemIterator('../minecraft-textures/Dyes');
              $end_files = new FilesystemIterator('../minecraft-textures/End');
              $food_files = new FilesystemIterator('../minecraft-textures/Food, Plants, and Passive Mob Drops');
              $hostile_drop_files = new FilesystemIterator('../minecraft-textures/Hostile Mob Drops');
              $mob_files = new FilesystemIterator('../minecraft-textures/Mobs, Animals, and NPCs');
              $music_files = new FilesystemIterator('../minecraft-textures/Music Discs');
              $nether_material_files = new FilesystemIterator('../minecraft-textures/Nether');
              $ocean_material_files = new FilesystemIterator('../minecraft-textures/Ocean');
              $ore_files = new FilesystemIterator('../minecraft-textures/Ores, Ingots, and Gems');
              $potion_files = new FilesystemIterator('../minecraft-textures/Potions and Tipped Arrows');
              $redstone_files = new FilesystemIterator('../minecraft-textures/Redstone');
              $removed_files = new FilesystemIterator('../minecraft-textures/Removed Features');
              $shulker_box_files = new FilesystemIterator('../minecraft-textures/Shulker Boxes');
              $spawn_egg_files = new FilesystemIterator('../minecraft-textures/Spawn Eggs');
              $tool_files = new FilesystemIterator('../minecraft-textures/Tools, Weapons, and Armor');
              $wood_files = new FilesystemIterator('../minecraft-textures/Wood (Logs, Planks, Sticks, etc)');

              foreach ($building_material_files as $fileInfo){$building[] = $fileInfo->getFilename();}
              sort($building);
              foreach ($utilities_files as $fileInfo){$utilities[] = $fileInfo->getFilename();}
              sort($utilities);
              foreach ($creative_files as $fileInfo){$creative[] = $fileInfo->getFilename();}
              sort($creative);
              foreach ($natural_material_files as $fileInfo){$natural[] = $fileInfo->getFilename();}
              sort($natural);
              foreach ($dye_files as $fileInfo){$dyes[] = $fileInfo->getFilename();}
              sort($dyes);
              foreach ($end_files as $fileInfo){$end[] = $fileInfo->getFilename();}
              sort($end);
              foreach ($food_files as $fileInfo){$food[] = $fileInfo->getFilename();}
              sort($food);
              foreach ($hostile_drop_files as $fileInfo){$hostile_drops[] = $fileInfo->getFilename();}
              sort($hostile_drops);
              foreach ($mob_files as $fileInfo){$mobs[] = $fileInfo->getFilename();}
              sort($mobs);
              foreach ($music_files as $fileInfo){$music[] = $fileInfo->getFilename();}
              sort($music);
              foreach ($nether_material_files as $fileInfo){$nether[] = $fileInfo->getFilename();}
              sort($nether);
              foreach ($ocean_material_files as $fileInfo){$ocean[] = $fileInfo->getFilename();}
              sort($ocean);
              foreach ($ore_files as $fileInfo){$ores[] = $fileInfo->getFilename();}
              sort($ores);
              foreach ($potion_files as $fileInfo){$potions[] = $fileInfo->getFilename();}
              sort($potions);
              foreach ($redstone_files as $fileInfo){$redstone[] = $fileInfo->getFilename();}
              sort($redstone);
              foreach ($removed_files as $fileInfo){$removed[] = $fileInfo->getFilename();}
              sort($removed);
              foreach ($shulker_box_files as $fileInfo){$shulker_boxes[] = $fileInfo->getFilename();}
              sort($shulker_boxes);
              foreach ($spawn_egg_files as $fileInfo){$spawn_eggs[] = $fileInfo->getFilename();}
              sort($spawn_eggs);
              foreach ($tool_files as $fileInfo){$tools[] = $fileInfo->getFilename();}
              sort($tools);
              foreach ($wood_files as $fileInfo){$wood[] = $fileInfo->getFilename();}
              sort($wood);

              $texture_array = [
                  "building" => $building,
                  "utilities" => $utilities,
                  "creative" => $creative,
                  "natural" => $natural,
                  "dyes" => $dyes,
                  "end" => $end,
                  "food" => $food,
                  "hostile_drops" => $hostile_drops,
                  "mobs" => $mobs,
                  "hostile_drops" => $hostile_drops,
                  "mobs" => $mobs,
                  "music" => $music,
                  "nether" => $nether,
                  "ocean" => $ocean,
                  "ores" => $ores,
                  "potions" => $potions,
                  "redstone" => $redstone,
                  "removed" => $removed,
                  "shulker_boxes" => $shulker_boxes,
                  "spawn_eggs" => $spawn_eggs,
                  "tools" => $tools,
                  "wood" => $wood
              ];
              ?>
              <script>
              var texture_array = <?php echo json_encode($texture_array) ?>;
              $(document).ready(function () {
                $("#category").change(function () {
                    var val = $(this).val();
                    if (val == "Building Materials") {
                        product_texture = document.getElementById('product_texture');
                        product_texture.innerHTML = ''
                          for(let i = 0; i < texture_array['building'].length; i++){
                              product_texture.innerHTML += "<option value='" + texture_array['building'][i] + "'>" + texture_array['building'][i] + "</option>";
                              if(i==0){
                                changeImage(document.getElementById('preview'), '../minecraft-textures/Building Materials/' + texture_array['building'][i])
                              }
                          }
                    } else if (val == "Crafting, Repairing, Smelting, and Storing") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['utilities'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['utilities'][i] + "'>" + texture_array['utilities'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Crafting, Repairing, Smelting, and Storing/' + texture_array['utilities'][i])
                            }
                        }
                    } else if (val == "Creative, Commands, and Education Edition") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['creative'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['creative'][i] + "'>" + texture_array['creative'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Creative, Commands, and Education Edition/' + texture_array['creative'][i])
                            }
                        }
                    } else if (val == "Dirt, Grass, Gravel, Sand, and Stones") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['natural'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['natural'][i] + "'>" + texture_array['natural'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Dirt, Grass, Gravel, Sand, and Stones/' + texture_array['natural'][i])
                            }
                        }
                    } else if (val == "Dyes") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['dyes'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['dyes'][i] + "'>" + texture_array['dyes'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Dyes/' + texture_array['dyes'][i])
                            }
                        }
                      } else if (val == "End") {
                        product_texture = document.getElementById('product_texture');
                        product_texture.innerHTML = ''
                          for(let i = 0; i < texture_array['end'].length; i++){
                              product_texture.innerHTML += "<option value='" + texture_array['end'][i] + "'>" + texture_array['end'][i] + "</option>";
                              if(i==0){
                                changeImage(document.getElementById('preview'), '../minecraft-textures/End/' + texture_array['end'][i])
                              }
                          }
                    } else if (val == "Food, Plants, and Passive Mob Drops") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['food'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['food'][i] + "'>" + texture_array['food'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Food, Plants, and Passive Mob Drops/' + texture_array['food'][i])
                            }
                        }
                    } else if (val == "Hostile Mob Drops") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['hostile_drops'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['hostile_drops'][i] + "'>" + texture_array['hostile_drops'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Hostile Mob Drops/' + texture_array['hostile_drops'][i])
                            }
                        }
                    } else if (val == "Mobs, Animals, and NPCs") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['mobs'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['mobs'][i] + "'>" + texture_array['mobs'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Mobs, Animals, and NPCs/' + texture_array['mobs'][i])
                            }
                        }
                    } else if (val == "Music Discs") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['music'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['music'][i] + "'>" + texture_array['music'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Music Discs/' + texture_array['music'][i])
                            }
                        }
                    } else if (val == "Nether") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['nether'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['nether'][i] + "'>" + texture_array['nether'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Nether/' + texture_array['nether'][i])
                            }
                        }
                    } else if (val == "Ocean") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['ocean'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['ocean'][i] + "'>" + texture_array['ocean'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Ocean/' + texture_array['ocean'][i])
                            }
                        }
                    } else if (val == "Ores, Ingots, and Gems") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['ores'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['ores'][i] + "'>" + texture_array['ores'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Ores, Ingots, and Gems/' + texture_array['ores'][i])
                            }
                        }
                    } else if (val == "Potions and Tipped Arrows") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['potions'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['potions'][i] + "'>" + texture_array['potions'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Potions and Tipped Arrows/' + texture_array['potions'][i])
                            }
                        }
                    } else if (val == "Redstone") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['redstone'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['redstone'][i] + "'>" + texture_array['redstone'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Redstone/' + texture_array['redstone'][i])
                            }
                        }
                    } else if (val == "Removed Features") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['removed'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['removed'][i] + "'>" + texture_array['removed'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Removed Features/' + texture_array['removed'][i])
                            }
                        }
                    } else if (val == "Shulker Boxes") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['shulker_boxes'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['shulker_boxes'][i] + "'>" + texture_array['shulker_boxes'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Shulker Boxes/' + texture_array['shulker_boxes'][i])
                            }
                        }
                    } else if (val == "Spawn Eggs") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['spawn_eggs'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['spawn_eggs'][i] + "'>" + texture_array['spawn_eggs'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Spawn Eggs/' + texture_array['spawn_eggs'][i])
                            }
                        }
                    } else if (val == "Tools, Weapons, and Armor") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['tools'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['tools'][i] + "'>" + texture_array['tools'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Tools, Weapons, and Armor/' + texture_array['tools'][i])
                            }
                        }
                    } else if (val == "Wood (Logs, Planks, Sticks, etc)") {
                      product_texture = document.getElementById('product_texture');
                      product_texture.innerHTML = ''
                        for(let i = 0; i < texture_array['wood'].length; i++){
                            product_texture.innerHTML += "<option value='" + texture_array['wood'][i] + "'>" + texture_array['wood'][i] + "</option>";
                            if(i==0){
                              changeImage(document.getElementById('preview'), '../minecraft-textures/Wood (Logs, Planks, Sticks, etc)/' + texture_array['wood'][i])
                            }
                        }
                    } else {
                        $("#product_texture").html("<option value=''>--select category to find texture--</option>");
                    }
                });
              });
              function changeImage(obj,img) {
                obj.src = img;
              }
              $(document).ready(function () {
                $("#product_texture").change(function () {
                    var file = $(this).val();
                    var folder = $("#category").val();
                    image = document.getElementById('preview');
                    changeImage(image,'../minecraft-textures/' + folder + '/' + file)
                  });
                });
              </script>
          </div>
          <div class="form-group">
            <label for="image">Interior Image (optional):</label>
            <input type="file" name="interior_image" id="interior_image">

          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          <br>
        </form>
      </div>
    </main>
    <?php include('footer.php') ?>
  </body>
  <script type="text/javascript">
  $("[data-toggle=popover]")
.popover({ html: true})
  .on("focus", function () {
      $(this).popover("show");
  }).on("focusout", function () {
      var _this = this;
      if (!$(".popover:hover").length) {
          $(this).popover("hide");
      }
      else {
          $('.popover').mouseleave(function() {
              $(_this).popover("hide");
              $(this).off('mouseleave');
          });
      }
  });
  </script>
</html>

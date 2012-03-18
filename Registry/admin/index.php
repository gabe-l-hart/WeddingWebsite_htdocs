<!-- Get PHP Utils -->
<?php
require '../../scripts/utils.php';
require '../../scripts/db.php';
require '../scripts/registry.php';
?>

<link rel="stylesheet" type="text/css" href="./css/registry.css">

<?php
  global $db_hostname;
  global $db_user;
  global $db_pw;
  global $db_name;

  // Set up registry
  $reg = new Registry();
  $reg->setHost($db_hostname);
  $reg->setUser($db_user);
  $reg->setPW($db_pw);
  $reg->setDBName($db_name);

  // Connect to DB
  $reg->connect();
?>

<?php pageHeader("../..", "Registry"); ?>
<?php subPageTop("../.."); ?>

  <!-- Title -->
  <p style="font-size:32px; text-align:center">Registry -- Admin</p>

  <!-- Description Text -->
  <div style="margin:10px;">
  <p>This is the admin page that allows you to add items to the registry database.</p>
  </div>

  <!-- Add Item Form -->
  <p style="font-size:20px; text-align:center">Add Item</p>

  <?php
  // Check for error message
  if (isset($_POST['error']))
  {
    echo "<p style='color:red'>Add failed: ".$_POST['error']."</p>";
  }
  // Check for success message
  if (isset($_POST['success_name']))
  {
    echo "<p style='color:green'>Successfully added ".$_POST['success_name']."</p>";
  }
  ?>

  <script type="text/javascript">
  function validate_field(form, field)
  {
    var fieldVal = document.forms[form][field].value;
    if (fieldVal == null || fieldVal == "")
    {
      alert("The \"" + field + "\" field is required");
      return false;
    }
    return true;
  }

  function submitAddFormIfValid() {
    if (!validate_field("Upload","name")) { return false; }
    if (!validate_field("Upload","requested")) { return false; }
    if (!validate_field("Upload","unit_price")) { return false; }
    if (!validate_field("Upload","file")) { return false; }
    if (!validate_field("Upload","longDescrip")) { return false; }
    return true;
  }
  </script>

  <form id="Upload" onsubmit="return submitAddFormIfValid()" action="./scripts/upload.php" enctype="multipart/form-data" method="post" >
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000"></input>
    <p>
      <label for="name">Name:</label>
      <input id="name" type="text" name="name" maxlength=256></input>
    </p>
    <p>
      <label for="link">Link (include http://):</label>
      <input id="link" type="text" name="link" maxlength=256></input>
    </p>
    <p>
      <label for="requested">Number Requested:</label>
      <input id="requested" type="text" name="requested" maxlength=3></input>
    </p>
    <p>
      <label for="unit_price">Unit Price: $</label>
      <input id="unit_price" type="text" name="unit_price" maxlength=3></input>
    </p>
    <p>
      <label for="file">Image to upload:</label> 
      <input id="file" type="file" name="file"> 
    </p>
    <p>
      <label for="longDescrip">Full Description:</label>
      <textarea id="longDescrip" type="text" name="longDescrip" maxlength=4096 rows=3 cols=40></textarea>
    </p>
    <p>
      <input id="submit" type="submit" name="submit" value="Add Item"> 
    </p>
  </form>

  <!-- Item Grid -->
  <?php $reg->populateItems(); ?>

<?php subPageBottom(); ?>
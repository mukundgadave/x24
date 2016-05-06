<?php session_start(); 
include_once('postgredb.php');

$_SESSION['SESSION_USER_ID'] = '0013600000J4sBa';
$dbname = "darst2mcouaoba";
$host = "ec2-54-243-243-135.compute-1.amazonaws.com";
$port = "5432";
$user = "xesnhndcygxlnm";
$password = "TyooRpybe-JZaZfKNDy4DGrDTC";
$persistent = 0;
$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
/* construct connection to database $dbname, with URL: $host, username is $user, password is $pass. If $persistent!=0 then function pg_pconnect is used otherwise pg_connect. */
$dbdrv->Begin();// Begin transaction block 
$sql="SELECT * FROM fitanfine.Account WHERE id = '".$_SESSION['SESSION_USER_ID']."'";
if (!$dbdrv->ExecQuery($sql)) // Execute query or die if error is occured
    die ($dbdrv->Error());

$result = $dbdrv->FetchResult($row, PGSQL_BOTH);

$name = $result['Name'];

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/salesforce-lightning-design-system.css">
  </head>
  <body>

  <div class="slds-page-header" role="banner">
  <div class="slds-media">
    <div class="slds-media__figure">
      <svg aria-hidden="true" class="slds-icon slds-icon--large slds-icon-standard-opportunity">
        <use xlink:href="/assets/icons/standard-sprite/svg/symbols.svg#opportunity"></use>
      </svg>
    </div>
    <div class="slds-media__body">
      <p class="slds-page-header__title slds-truncate slds-align-middle" title="Rohde Corp - 80,000 Widgets">HealthIsWealth</p>
      <p class="slds-text-body--small slds-page-header__info"><?php echo $name .". System Administrator • ". date(); ?></p>
    </div>
  </div>
</div>
<div style="padding: 25px 10px;">
<div class="slds-grid slds-wrap slds-grid--pull-padded">
 <div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
 <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
      <!-- <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Diet Plan</span> 
  </button>
  </div>
  <div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
   <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
     <!--  <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Target</span> 
  </button></div><div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
   <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
      <!-- <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Expenses Point</span> 
  </button></div><div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
  <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
      <!-- <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Points</span> 
  </button></div><div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
  <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
      <!-- <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Affiliation</span> 
  </button></div><div class="slds-col--padded slds-size--1-of-1 slds-medium-size--1-of-2 slds-large-size--1-of-3">
  <button class="slds-button slds-button--neutral slds-not-selected" aria-live="assertive">
    <span class="slds-text-not-selected">
     <!--  <svg aria-hidden="true" class="slds-button__icon--stateful slds-button__icon--left">
        <use xlink:href="assets/icons/utility-sprite/svg/symbols.svg#add"></use>
      </svg> -->Leader Board</span> 
  </button></div>
</div>
</div>
  </body>
</html>
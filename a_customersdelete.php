<?php
namespace PHPMaker2020\project2;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$a_customers_delete = new a_customers_delete();

// Run the page
$a_customers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_customers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_customersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fa_customersdelete = currentForm = new ew.Form("fa_customersdelete", "delete");
	loadjs.done("fa_customersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_customers_delete->showPageHeader(); ?>
<?php
$a_customers_delete->showMessage();
?>
<form name="fa_customersdelete" id="fa_customersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_customers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($a_customers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($a_customers_delete->Customer_ID->Visible) { // Customer_ID ?>
		<th class="<?php echo $a_customers_delete->Customer_ID->headerCellClass() ?>"><span id="elh_a_customers_Customer_ID" class="a_customers_Customer_ID"><?php echo $a_customers_delete->Customer_ID->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Customer_Number->Visible) { // Customer_Number ?>
		<th class="<?php echo $a_customers_delete->Customer_Number->headerCellClass() ?>"><span id="elh_a_customers_Customer_Number" class="a_customers_Customer_Number"><?php echo $a_customers_delete->Customer_Number->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Customer_Name->Visible) { // Customer_Name ?>
		<th class="<?php echo $a_customers_delete->Customer_Name->headerCellClass() ?>"><span id="elh_a_customers_Customer_Name" class="a_customers_Customer_Name"><?php echo $a_customers_delete->Customer_Name->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->City->Visible) { // City ?>
		<th class="<?php echo $a_customers_delete->City->headerCellClass() ?>"><span id="elh_a_customers_City" class="a_customers_City"><?php echo $a_customers_delete->City->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Country->Visible) { // Country ?>
		<th class="<?php echo $a_customers_delete->Country->headerCellClass() ?>"><span id="elh_a_customers_Country" class="a_customers_Country"><?php echo $a_customers_delete->Country->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Contact_Person->Visible) { // Contact_Person ?>
		<th class="<?php echo $a_customers_delete->Contact_Person->headerCellClass() ?>"><span id="elh_a_customers_Contact_Person" class="a_customers_Contact_Person"><?php echo $a_customers_delete->Contact_Person->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Phone_Number->Visible) { // Phone_Number ?>
		<th class="<?php echo $a_customers_delete->Phone_Number->headerCellClass() ?>"><span id="elh_a_customers_Phone_Number" class="a_customers_Phone_Number"><?php echo $a_customers_delete->Phone_Number->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $a_customers_delete->_Email->headerCellClass() ?>"><span id="elh_a_customers__Email" class="a_customers__Email"><?php echo $a_customers_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Mobile_Number->Visible) { // Mobile_Number ?>
		<th class="<?php echo $a_customers_delete->Mobile_Number->headerCellClass() ?>"><span id="elh_a_customers_Mobile_Number" class="a_customers_Mobile_Number"><?php echo $a_customers_delete->Mobile_Number->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Notes->Visible) { // Notes ?>
		<th class="<?php echo $a_customers_delete->Notes->headerCellClass() ?>"><span id="elh_a_customers_Notes" class="a_customers_Notes"><?php echo $a_customers_delete->Notes->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Balance->Visible) { // Balance ?>
		<th class="<?php echo $a_customers_delete->Balance->headerCellClass() ?>"><span id="elh_a_customers_Balance" class="a_customers_Balance"><?php echo $a_customers_delete->Balance->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Date_Added->Visible) { // Date_Added ?>
		<th class="<?php echo $a_customers_delete->Date_Added->headerCellClass() ?>"><span id="elh_a_customers_Date_Added" class="a_customers_Date_Added"><?php echo $a_customers_delete->Date_Added->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Added_By->Visible) { // Added_By ?>
		<th class="<?php echo $a_customers_delete->Added_By->headerCellClass() ?>"><span id="elh_a_customers_Added_By" class="a_customers_Added_By"><?php echo $a_customers_delete->Added_By->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Date_Updated->Visible) { // Date_Updated ?>
		<th class="<?php echo $a_customers_delete->Date_Updated->headerCellClass() ?>"><span id="elh_a_customers_Date_Updated" class="a_customers_Date_Updated"><?php echo $a_customers_delete->Date_Updated->caption() ?></span></th>
<?php } ?>
<?php if ($a_customers_delete->Updated_By->Visible) { // Updated_By ?>
		<th class="<?php echo $a_customers_delete->Updated_By->headerCellClass() ?>"><span id="elh_a_customers_Updated_By" class="a_customers_Updated_By"><?php echo $a_customers_delete->Updated_By->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$a_customers_delete->RecordCount = 0;
$i = 0;
while (!$a_customers_delete->Recordset->EOF) {
	$a_customers_delete->RecordCount++;
	$a_customers_delete->RowCount++;

	// Set row properties
	$a_customers->resetAttributes();
	$a_customers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$a_customers_delete->loadRowValues($a_customers_delete->Recordset);

	// Render row
	$a_customers_delete->renderRow();
?>
	<tr <?php echo $a_customers->rowAttributes() ?>>
<?php if ($a_customers_delete->Customer_ID->Visible) { // Customer_ID ?>
		<td <?php echo $a_customers_delete->Customer_ID->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Customer_ID" class="a_customers_Customer_ID">
<span<?php echo $a_customers_delete->Customer_ID->viewAttributes() ?>><?php echo $a_customers_delete->Customer_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Customer_Number->Visible) { // Customer_Number ?>
		<td <?php echo $a_customers_delete->Customer_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Customer_Number" class="a_customers_Customer_Number">
<span<?php echo $a_customers_delete->Customer_Number->viewAttributes() ?>><?php echo $a_customers_delete->Customer_Number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Customer_Name->Visible) { // Customer_Name ?>
		<td <?php echo $a_customers_delete->Customer_Name->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Customer_Name" class="a_customers_Customer_Name">
<span<?php echo $a_customers_delete->Customer_Name->viewAttributes() ?>><?php echo $a_customers_delete->Customer_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->City->Visible) { // City ?>
		<td <?php echo $a_customers_delete->City->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_City" class="a_customers_City">
<span<?php echo $a_customers_delete->City->viewAttributes() ?>><?php echo $a_customers_delete->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Country->Visible) { // Country ?>
		<td <?php echo $a_customers_delete->Country->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Country" class="a_customers_Country">
<span<?php echo $a_customers_delete->Country->viewAttributes() ?>><?php echo $a_customers_delete->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Contact_Person->Visible) { // Contact_Person ?>
		<td <?php echo $a_customers_delete->Contact_Person->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Contact_Person" class="a_customers_Contact_Person">
<span<?php echo $a_customers_delete->Contact_Person->viewAttributes() ?>><?php echo $a_customers_delete->Contact_Person->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Phone_Number->Visible) { // Phone_Number ?>
		<td <?php echo $a_customers_delete->Phone_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Phone_Number" class="a_customers_Phone_Number">
<span<?php echo $a_customers_delete->Phone_Number->viewAttributes() ?>><?php echo $a_customers_delete->Phone_Number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->_Email->Visible) { // Email ?>
		<td <?php echo $a_customers_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers__Email" class="a_customers__Email">
<span<?php echo $a_customers_delete->_Email->viewAttributes() ?>><?php echo $a_customers_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Mobile_Number->Visible) { // Mobile_Number ?>
		<td <?php echo $a_customers_delete->Mobile_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Mobile_Number" class="a_customers_Mobile_Number">
<span<?php echo $a_customers_delete->Mobile_Number->viewAttributes() ?>><?php echo $a_customers_delete->Mobile_Number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Notes->Visible) { // Notes ?>
		<td <?php echo $a_customers_delete->Notes->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Notes" class="a_customers_Notes">
<span<?php echo $a_customers_delete->Notes->viewAttributes() ?>><?php echo $a_customers_delete->Notes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Balance->Visible) { // Balance ?>
		<td <?php echo $a_customers_delete->Balance->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Balance" class="a_customers_Balance">
<span<?php echo $a_customers_delete->Balance->viewAttributes() ?>><?php echo $a_customers_delete->Balance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Date_Added->Visible) { // Date_Added ?>
		<td <?php echo $a_customers_delete->Date_Added->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Date_Added" class="a_customers_Date_Added">
<span<?php echo $a_customers_delete->Date_Added->viewAttributes() ?>><?php echo $a_customers_delete->Date_Added->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Added_By->Visible) { // Added_By ?>
		<td <?php echo $a_customers_delete->Added_By->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Added_By" class="a_customers_Added_By">
<span<?php echo $a_customers_delete->Added_By->viewAttributes() ?>><?php echo $a_customers_delete->Added_By->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Date_Updated->Visible) { // Date_Updated ?>
		<td <?php echo $a_customers_delete->Date_Updated->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Date_Updated" class="a_customers_Date_Updated">
<span<?php echo $a_customers_delete->Date_Updated->viewAttributes() ?>><?php echo $a_customers_delete->Date_Updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($a_customers_delete->Updated_By->Visible) { // Updated_By ?>
		<td <?php echo $a_customers_delete->Updated_By->cellAttributes() ?>>
<span id="el<?php echo $a_customers_delete->RowCount ?>_a_customers_Updated_By" class="a_customers_Updated_By">
<span<?php echo $a_customers_delete->Updated_By->viewAttributes() ?>><?php echo $a_customers_delete->Updated_By->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$a_customers_delete->Recordset->moveNext();
}
$a_customers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_customers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$a_customers_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$a_customers_delete->terminate();
?>
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
$a_suppliers_add = new a_suppliers_add();

// Run the page
$a_suppliers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_suppliers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_suppliersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fa_suppliersadd = currentForm = new ew.Form("fa_suppliersadd", "add");

	// Validate form
	fa_suppliersadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($a_suppliers_add->Supplier_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Supplier_Number->caption(), $a_suppliers_add->Supplier_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Supplier_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Supplier_Name->caption(), $a_suppliers_add->Supplier_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Address->caption(), $a_suppliers_add->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->City->Required) { ?>
				elm = this.getElements("x" + infix + "_City");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->City->caption(), $a_suppliers_add->City->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Country->caption(), $a_suppliers_add->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Contact_Person->Required) { ?>
				elm = this.getElements("x" + infix + "_Contact_Person");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Contact_Person->caption(), $a_suppliers_add->Contact_Person->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Phone_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Phone_Number->caption(), $a_suppliers_add->Phone_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->_Email->caption(), $a_suppliers_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Mobile_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Mobile_Number->caption(), $a_suppliers_add->Mobile_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Notes->Required) { ?>
				elm = this.getElements("x" + infix + "_Notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Notes->caption(), $a_suppliers_add->Notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Balance->caption(), $a_suppliers_add->Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_suppliers_add->Balance->errorMessage()) ?>");
			<?php if ($a_suppliers_add->Is_Stock_Available->Required) { ?>
				elm = this.getElements("x" + infix + "_Is_Stock_Available[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Is_Stock_Available->caption(), $a_suppliers_add->Is_Stock_Available->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Date_Added->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Date_Added->caption(), $a_suppliers_add->Date_Added->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_suppliers_add->Date_Added->errorMessage()) ?>");
			<?php if ($a_suppliers_add->Added_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Added_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Added_By->caption(), $a_suppliers_add->Added_By->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_suppliers_add->Date_Updated->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Date_Updated->caption(), $a_suppliers_add->Date_Updated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_suppliers_add->Date_Updated->errorMessage()) ?>");
			<?php if ($a_suppliers_add->Updated_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Updated_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_suppliers_add->Updated_By->caption(), $a_suppliers_add->Updated_By->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fa_suppliersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fa_suppliersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fa_suppliersadd.lists["x_Is_Stock_Available[]"] = <?php echo $a_suppliers_add->Is_Stock_Available->Lookup->toClientList($a_suppliers_add) ?>;
	fa_suppliersadd.lists["x_Is_Stock_Available[]"].options = <?php echo JsonEncode($a_suppliers_add->Is_Stock_Available->options(FALSE, TRUE)) ?>;
	loadjs.done("fa_suppliersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_suppliers_add->showPageHeader(); ?>
<?php
$a_suppliers_add->showMessage();
?>
<form name="fa_suppliersadd" id="fa_suppliersadd" class="<?php echo $a_suppliers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_suppliers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$a_suppliers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($a_suppliers_add->Supplier_Number->Visible) { // Supplier_Number ?>
	<div id="r_Supplier_Number" class="form-group row">
		<label id="elh_a_suppliers_Supplier_Number" for="x_Supplier_Number" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Supplier_Number->caption() ?><?php echo $a_suppliers_add->Supplier_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Supplier_Number->cellAttributes() ?>>
<span id="el_a_suppliers_Supplier_Number">
<input type="text" data-table="a_suppliers" data-field="x_Supplier_Number" name="x_Supplier_Number" id="x_Supplier_Number" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_suppliers_add->Supplier_Number->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Supplier_Number->EditValue ?>"<?php echo $a_suppliers_add->Supplier_Number->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Supplier_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Supplier_Name->Visible) { // Supplier_Name ?>
	<div id="r_Supplier_Name" class="form-group row">
		<label id="elh_a_suppliers_Supplier_Name" for="x_Supplier_Name" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Supplier_Name->caption() ?><?php echo $a_suppliers_add->Supplier_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Supplier_Name->cellAttributes() ?>>
<span id="el_a_suppliers_Supplier_Name">
<input type="text" data-table="a_suppliers" data-field="x_Supplier_Name" name="x_Supplier_Name" id="x_Supplier_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Supplier_Name->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Supplier_Name->EditValue ?>"<?php echo $a_suppliers_add->Supplier_Name->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Supplier_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_a_suppliers_Address" for="x_Address" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Address->caption() ?><?php echo $a_suppliers_add->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Address->cellAttributes() ?>>
<span id="el_a_suppliers_Address">
<textarea data-table="a_suppliers" data-field="x_Address" name="x_Address" id="x_Address" cols="35" rows="4" placeholder="<?php echo HtmlEncode($a_suppliers_add->Address->getPlaceHolder()) ?>"<?php echo $a_suppliers_add->Address->editAttributes() ?>><?php echo $a_suppliers_add->Address->EditValue ?></textarea>
</span>
<?php echo $a_suppliers_add->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->City->Visible) { // City ?>
	<div id="r_City" class="form-group row">
		<label id="elh_a_suppliers_City" for="x_City" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->City->caption() ?><?php echo $a_suppliers_add->City->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->City->cellAttributes() ?>>
<span id="el_a_suppliers_City">
<input type="text" data-table="a_suppliers" data-field="x_City" name="x_City" id="x_City" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_suppliers_add->City->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->City->EditValue ?>"<?php echo $a_suppliers_add->City->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->City->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_a_suppliers_Country" for="x_Country" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Country->caption() ?><?php echo $a_suppliers_add->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Country->cellAttributes() ?>>
<span id="el_a_suppliers_Country">
<input type="text" data-table="a_suppliers" data-field="x_Country" name="x_Country" id="x_Country" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Country->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Country->EditValue ?>"<?php echo $a_suppliers_add->Country->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Contact_Person->Visible) { // Contact_Person ?>
	<div id="r_Contact_Person" class="form-group row">
		<label id="elh_a_suppliers_Contact_Person" for="x_Contact_Person" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Contact_Person->caption() ?><?php echo $a_suppliers_add->Contact_Person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Contact_Person->cellAttributes() ?>>
<span id="el_a_suppliers_Contact_Person">
<input type="text" data-table="a_suppliers" data-field="x_Contact_Person" name="x_Contact_Person" id="x_Contact_Person" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Contact_Person->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Contact_Person->EditValue ?>"<?php echo $a_suppliers_add->Contact_Person->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Contact_Person->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Phone_Number->Visible) { // Phone_Number ?>
	<div id="r_Phone_Number" class="form-group row">
		<label id="elh_a_suppliers_Phone_Number" for="x_Phone_Number" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Phone_Number->caption() ?><?php echo $a_suppliers_add->Phone_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Phone_Number->cellAttributes() ?>>
<span id="el_a_suppliers_Phone_Number">
<input type="text" data-table="a_suppliers" data-field="x_Phone_Number" name="x_Phone_Number" id="x_Phone_Number" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Phone_Number->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Phone_Number->EditValue ?>"<?php echo $a_suppliers_add->Phone_Number->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Phone_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_a_suppliers__Email" for="x__Email" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->_Email->caption() ?><?php echo $a_suppliers_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->_Email->cellAttributes() ?>>
<span id="el_a_suppliers__Email">
<input type="text" data-table="a_suppliers" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($a_suppliers_add->_Email->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->_Email->EditValue ?>"<?php echo $a_suppliers_add->_Email->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Mobile_Number->Visible) { // Mobile_Number ?>
	<div id="r_Mobile_Number" class="form-group row">
		<label id="elh_a_suppliers_Mobile_Number" for="x_Mobile_Number" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Mobile_Number->caption() ?><?php echo $a_suppliers_add->Mobile_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Mobile_Number->cellAttributes() ?>>
<span id="el_a_suppliers_Mobile_Number">
<input type="text" data-table="a_suppliers" data-field="x_Mobile_Number" name="x_Mobile_Number" id="x_Mobile_Number" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Mobile_Number->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Mobile_Number->EditValue ?>"<?php echo $a_suppliers_add->Mobile_Number->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Mobile_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Notes->Visible) { // Notes ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_a_suppliers_Notes" for="x_Notes" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Notes->caption() ?><?php echo $a_suppliers_add->Notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Notes->cellAttributes() ?>>
<span id="el_a_suppliers_Notes">
<textarea data-table="a_suppliers" data-field="x_Notes" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($a_suppliers_add->Notes->getPlaceHolder()) ?>"<?php echo $a_suppliers_add->Notes->editAttributes() ?>><?php echo $a_suppliers_add->Notes->EditValue ?></textarea>
</span>
<?php echo $a_suppliers_add->Notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Balance->Visible) { // Balance ?>
	<div id="r_Balance" class="form-group row">
		<label id="elh_a_suppliers_Balance" for="x_Balance" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Balance->caption() ?><?php echo $a_suppliers_add->Balance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Balance->cellAttributes() ?>>
<span id="el_a_suppliers_Balance">
<input type="text" data-table="a_suppliers" data-field="x_Balance" name="x_Balance" id="x_Balance" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_suppliers_add->Balance->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Balance->EditValue ?>"<?php echo $a_suppliers_add->Balance->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Balance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Is_Stock_Available->Visible) { // Is_Stock_Available ?>
	<div id="r_Is_Stock_Available" class="form-group row">
		<label id="elh_a_suppliers_Is_Stock_Available" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Is_Stock_Available->caption() ?><?php echo $a_suppliers_add->Is_Stock_Available->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Is_Stock_Available->cellAttributes() ?>>
<span id="el_a_suppliers_Is_Stock_Available">
<?php
$selwrk = ConvertToBool($a_suppliers_add->Is_Stock_Available->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="a_suppliers" data-field="x_Is_Stock_Available" name="x_Is_Stock_Available[]" id="x_Is_Stock_Available[]" value="1"<?php echo $selwrk ?><?php echo $a_suppliers_add->Is_Stock_Available->editAttributes() ?>>
	<label class="custom-control-label" for="x_Is_Stock_Available[]"></label>
</div>
</span>
<?php echo $a_suppliers_add->Is_Stock_Available->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Date_Added->Visible) { // Date_Added ?>
	<div id="r_Date_Added" class="form-group row">
		<label id="elh_a_suppliers_Date_Added" for="x_Date_Added" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Date_Added->caption() ?><?php echo $a_suppliers_add->Date_Added->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Date_Added->cellAttributes() ?>>
<span id="el_a_suppliers_Date_Added">
<input type="text" data-table="a_suppliers" data-field="x_Date_Added" name="x_Date_Added" id="x_Date_Added" maxlength="19" placeholder="<?php echo HtmlEncode($a_suppliers_add->Date_Added->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Date_Added->EditValue ?>"<?php echo $a_suppliers_add->Date_Added->editAttributes() ?>>
<?php if (!$a_suppliers_add->Date_Added->ReadOnly && !$a_suppliers_add->Date_Added->Disabled && !isset($a_suppliers_add->Date_Added->EditAttrs["readonly"]) && !isset($a_suppliers_add->Date_Added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_suppliersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_suppliersadd", "x_Date_Added", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_suppliers_add->Date_Added->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Added_By->Visible) { // Added_By ?>
	<div id="r_Added_By" class="form-group row">
		<label id="elh_a_suppliers_Added_By" for="x_Added_By" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Added_By->caption() ?><?php echo $a_suppliers_add->Added_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Added_By->cellAttributes() ?>>
<span id="el_a_suppliers_Added_By">
<input type="text" data-table="a_suppliers" data-field="x_Added_By" name="x_Added_By" id="x_Added_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Added_By->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Added_By->EditValue ?>"<?php echo $a_suppliers_add->Added_By->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Added_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Date_Updated->Visible) { // Date_Updated ?>
	<div id="r_Date_Updated" class="form-group row">
		<label id="elh_a_suppliers_Date_Updated" for="x_Date_Updated" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Date_Updated->caption() ?><?php echo $a_suppliers_add->Date_Updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Date_Updated->cellAttributes() ?>>
<span id="el_a_suppliers_Date_Updated">
<input type="text" data-table="a_suppliers" data-field="x_Date_Updated" name="x_Date_Updated" id="x_Date_Updated" maxlength="19" placeholder="<?php echo HtmlEncode($a_suppliers_add->Date_Updated->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Date_Updated->EditValue ?>"<?php echo $a_suppliers_add->Date_Updated->editAttributes() ?>>
<?php if (!$a_suppliers_add->Date_Updated->ReadOnly && !$a_suppliers_add->Date_Updated->Disabled && !isset($a_suppliers_add->Date_Updated->EditAttrs["readonly"]) && !isset($a_suppliers_add->Date_Updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_suppliersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_suppliersadd", "x_Date_Updated", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_suppliers_add->Date_Updated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_suppliers_add->Updated_By->Visible) { // Updated_By ?>
	<div id="r_Updated_By" class="form-group row">
		<label id="elh_a_suppliers_Updated_By" for="x_Updated_By" class="<?php echo $a_suppliers_add->LeftColumnClass ?>"><?php echo $a_suppliers_add->Updated_By->caption() ?><?php echo $a_suppliers_add->Updated_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_suppliers_add->RightColumnClass ?>"><div <?php echo $a_suppliers_add->Updated_By->cellAttributes() ?>>
<span id="el_a_suppliers_Updated_By">
<input type="text" data-table="a_suppliers" data-field="x_Updated_By" name="x_Updated_By" id="x_Updated_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_suppliers_add->Updated_By->getPlaceHolder()) ?>" value="<?php echo $a_suppliers_add->Updated_By->EditValue ?>"<?php echo $a_suppliers_add->Updated_By->editAttributes() ?>>
</span>
<?php echo $a_suppliers_add->Updated_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$a_suppliers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $a_suppliers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_suppliers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$a_suppliers_add->showPageFooter();
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
$a_suppliers_add->terminate();
?>
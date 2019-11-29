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
$a_purchases_add = new a_purchases_add();

// Run the page
$a_purchases_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_purchases_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_purchasesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fa_purchasesadd = currentForm = new ew.Form("fa_purchasesadd", "add");

	// Validate form
	fa_purchasesadd.validate = function() {
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
			<?php if ($a_purchases_add->Purchase_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Purchase_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Purchase_Number->caption(), $a_purchases_add->Purchase_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_purchases_add->Purchase_Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Purchase_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Purchase_Date->caption(), $a_purchases_add->Purchase_Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Purchase_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Purchase_Date->errorMessage()) ?>");
			<?php if ($a_purchases_add->Supplier_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Supplier_ID->caption(), $a_purchases_add->Supplier_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_purchases_add->Notes->Required) { ?>
				elm = this.getElements("x" + infix + "_Notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Notes->caption(), $a_purchases_add->Notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_purchases_add->Total_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Total_Amount->caption(), $a_purchases_add->Total_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Total_Amount->errorMessage()) ?>");
			<?php if ($a_purchases_add->Total_Payment->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Payment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Total_Payment->caption(), $a_purchases_add->Total_Payment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Payment");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Total_Payment->errorMessage()) ?>");
			<?php if ($a_purchases_add->Total_Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Total_Balance->caption(), $a_purchases_add->Total_Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Total_Balance->errorMessage()) ?>");
			<?php if ($a_purchases_add->Date_Added->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Date_Added->caption(), $a_purchases_add->Date_Added->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Date_Added->errorMessage()) ?>");
			<?php if ($a_purchases_add->Added_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Added_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Added_By->caption(), $a_purchases_add->Added_By->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_purchases_add->Date_Updated->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Date_Updated->caption(), $a_purchases_add->Date_Updated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_purchases_add->Date_Updated->errorMessage()) ?>");
			<?php if ($a_purchases_add->Updated_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Updated_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_purchases_add->Updated_By->caption(), $a_purchases_add->Updated_By->RequiredErrorMessage)) ?>");
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
	fa_purchasesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fa_purchasesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fa_purchasesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_purchases_add->showPageHeader(); ?>
<?php
$a_purchases_add->showMessage();
?>
<form name="fa_purchasesadd" id="fa_purchasesadd" class="<?php echo $a_purchases_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_purchases">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$a_purchases_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($a_purchases_add->Purchase_Number->Visible) { // Purchase_Number ?>
	<div id="r_Purchase_Number" class="form-group row">
		<label id="elh_a_purchases_Purchase_Number" for="x_Purchase_Number" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Purchase_Number->caption() ?><?php echo $a_purchases_add->Purchase_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Purchase_Number->cellAttributes() ?>>
<span id="el_a_purchases_Purchase_Number">
<input type="text" data-table="a_purchases" data-field="x_Purchase_Number" name="x_Purchase_Number" id="x_Purchase_Number" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_purchases_add->Purchase_Number->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Purchase_Number->EditValue ?>"<?php echo $a_purchases_add->Purchase_Number->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Purchase_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Purchase_Date->Visible) { // Purchase_Date ?>
	<div id="r_Purchase_Date" class="form-group row">
		<label id="elh_a_purchases_Purchase_Date" for="x_Purchase_Date" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Purchase_Date->caption() ?><?php echo $a_purchases_add->Purchase_Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Purchase_Date->cellAttributes() ?>>
<span id="el_a_purchases_Purchase_Date">
<input type="text" data-table="a_purchases" data-field="x_Purchase_Date" name="x_Purchase_Date" id="x_Purchase_Date" maxlength="19" placeholder="<?php echo HtmlEncode($a_purchases_add->Purchase_Date->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Purchase_Date->EditValue ?>"<?php echo $a_purchases_add->Purchase_Date->editAttributes() ?>>
<?php if (!$a_purchases_add->Purchase_Date->ReadOnly && !$a_purchases_add->Purchase_Date->Disabled && !isset($a_purchases_add->Purchase_Date->EditAttrs["readonly"]) && !isset($a_purchases_add->Purchase_Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_purchasesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_purchasesadd", "x_Purchase_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_purchases_add->Purchase_Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Supplier_ID->Visible) { // Supplier_ID ?>
	<div id="r_Supplier_ID" class="form-group row">
		<label id="elh_a_purchases_Supplier_ID" for="x_Supplier_ID" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Supplier_ID->caption() ?><?php echo $a_purchases_add->Supplier_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Supplier_ID->cellAttributes() ?>>
<span id="el_a_purchases_Supplier_ID">
<input type="text" data-table="a_purchases" data-field="x_Supplier_ID" name="x_Supplier_ID" id="x_Supplier_ID" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_purchases_add->Supplier_ID->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Supplier_ID->EditValue ?>"<?php echo $a_purchases_add->Supplier_ID->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Supplier_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Notes->Visible) { // Notes ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_a_purchases_Notes" for="x_Notes" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Notes->caption() ?><?php echo $a_purchases_add->Notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Notes->cellAttributes() ?>>
<span id="el_a_purchases_Notes">
<input type="text" data-table="a_purchases" data-field="x_Notes" name="x_Notes" id="x_Notes" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_purchases_add->Notes->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Notes->EditValue ?>"<?php echo $a_purchases_add->Notes->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Total_Amount->Visible) { // Total_Amount ?>
	<div id="r_Total_Amount" class="form-group row">
		<label id="elh_a_purchases_Total_Amount" for="x_Total_Amount" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Total_Amount->caption() ?><?php echo $a_purchases_add->Total_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Total_Amount->cellAttributes() ?>>
<span id="el_a_purchases_Total_Amount">
<input type="text" data-table="a_purchases" data-field="x_Total_Amount" name="x_Total_Amount" id="x_Total_Amount" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_purchases_add->Total_Amount->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Total_Amount->EditValue ?>"<?php echo $a_purchases_add->Total_Amount->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Total_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Total_Payment->Visible) { // Total_Payment ?>
	<div id="r_Total_Payment" class="form-group row">
		<label id="elh_a_purchases_Total_Payment" for="x_Total_Payment" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Total_Payment->caption() ?><?php echo $a_purchases_add->Total_Payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Total_Payment->cellAttributes() ?>>
<span id="el_a_purchases_Total_Payment">
<input type="text" data-table="a_purchases" data-field="x_Total_Payment" name="x_Total_Payment" id="x_Total_Payment" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_purchases_add->Total_Payment->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Total_Payment->EditValue ?>"<?php echo $a_purchases_add->Total_Payment->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Total_Payment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Total_Balance->Visible) { // Total_Balance ?>
	<div id="r_Total_Balance" class="form-group row">
		<label id="elh_a_purchases_Total_Balance" for="x_Total_Balance" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Total_Balance->caption() ?><?php echo $a_purchases_add->Total_Balance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Total_Balance->cellAttributes() ?>>
<span id="el_a_purchases_Total_Balance">
<input type="text" data-table="a_purchases" data-field="x_Total_Balance" name="x_Total_Balance" id="x_Total_Balance" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_purchases_add->Total_Balance->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Total_Balance->EditValue ?>"<?php echo $a_purchases_add->Total_Balance->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Total_Balance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Date_Added->Visible) { // Date_Added ?>
	<div id="r_Date_Added" class="form-group row">
		<label id="elh_a_purchases_Date_Added" for="x_Date_Added" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Date_Added->caption() ?><?php echo $a_purchases_add->Date_Added->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Date_Added->cellAttributes() ?>>
<span id="el_a_purchases_Date_Added">
<input type="text" data-table="a_purchases" data-field="x_Date_Added" name="x_Date_Added" id="x_Date_Added" maxlength="19" placeholder="<?php echo HtmlEncode($a_purchases_add->Date_Added->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Date_Added->EditValue ?>"<?php echo $a_purchases_add->Date_Added->editAttributes() ?>>
<?php if (!$a_purchases_add->Date_Added->ReadOnly && !$a_purchases_add->Date_Added->Disabled && !isset($a_purchases_add->Date_Added->EditAttrs["readonly"]) && !isset($a_purchases_add->Date_Added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_purchasesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_purchasesadd", "x_Date_Added", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_purchases_add->Date_Added->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Added_By->Visible) { // Added_By ?>
	<div id="r_Added_By" class="form-group row">
		<label id="elh_a_purchases_Added_By" for="x_Added_By" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Added_By->caption() ?><?php echo $a_purchases_add->Added_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Added_By->cellAttributes() ?>>
<span id="el_a_purchases_Added_By">
<input type="text" data-table="a_purchases" data-field="x_Added_By" name="x_Added_By" id="x_Added_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_purchases_add->Added_By->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Added_By->EditValue ?>"<?php echo $a_purchases_add->Added_By->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Added_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Date_Updated->Visible) { // Date_Updated ?>
	<div id="r_Date_Updated" class="form-group row">
		<label id="elh_a_purchases_Date_Updated" for="x_Date_Updated" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Date_Updated->caption() ?><?php echo $a_purchases_add->Date_Updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Date_Updated->cellAttributes() ?>>
<span id="el_a_purchases_Date_Updated">
<input type="text" data-table="a_purchases" data-field="x_Date_Updated" name="x_Date_Updated" id="x_Date_Updated" maxlength="19" placeholder="<?php echo HtmlEncode($a_purchases_add->Date_Updated->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Date_Updated->EditValue ?>"<?php echo $a_purchases_add->Date_Updated->editAttributes() ?>>
<?php if (!$a_purchases_add->Date_Updated->ReadOnly && !$a_purchases_add->Date_Updated->Disabled && !isset($a_purchases_add->Date_Updated->EditAttrs["readonly"]) && !isset($a_purchases_add->Date_Updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_purchasesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_purchasesadd", "x_Date_Updated", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_purchases_add->Date_Updated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_purchases_add->Updated_By->Visible) { // Updated_By ?>
	<div id="r_Updated_By" class="form-group row">
		<label id="elh_a_purchases_Updated_By" for="x_Updated_By" class="<?php echo $a_purchases_add->LeftColumnClass ?>"><?php echo $a_purchases_add->Updated_By->caption() ?><?php echo $a_purchases_add->Updated_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_purchases_add->RightColumnClass ?>"><div <?php echo $a_purchases_add->Updated_By->cellAttributes() ?>>
<span id="el_a_purchases_Updated_By">
<input type="text" data-table="a_purchases" data-field="x_Updated_By" name="x_Updated_By" id="x_Updated_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_purchases_add->Updated_By->getPlaceHolder()) ?>" value="<?php echo $a_purchases_add->Updated_By->EditValue ?>"<?php echo $a_purchases_add->Updated_By->editAttributes() ?>>
</span>
<?php echo $a_purchases_add->Updated_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$a_purchases_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $a_purchases_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_purchases_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$a_purchases_add->showPageFooter();
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
$a_purchases_add->terminate();
?>
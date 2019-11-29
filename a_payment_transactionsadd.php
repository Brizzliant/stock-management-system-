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
$a_payment_transactions_add = new a_payment_transactions_add();

// Run the page
$a_payment_transactions_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_payment_transactions_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_payment_transactionsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fa_payment_transactionsadd = currentForm = new ew.Form("fa_payment_transactionsadd", "add");

	// Validate form
	fa_payment_transactionsadd.validate = function() {
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
			<?php if ($a_payment_transactions_add->Ref_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Ref_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Ref_ID->caption(), $a_payment_transactions_add->Ref_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_payment_transactions_add->Type->Required) { ?>
				elm = this.getElements("x" + infix + "_Type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Type->caption(), $a_payment_transactions_add->Type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_payment_transactions_add->Customer->Required) { ?>
				elm = this.getElements("x" + infix + "_Customer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Customer->caption(), $a_payment_transactions_add->Customer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_payment_transactions_add->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Supplier->caption(), $a_payment_transactions_add->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_payment_transactions_add->Sub_Total->Required) { ?>
				elm = this.getElements("x" + infix + "_Sub_Total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Sub_Total->caption(), $a_payment_transactions_add->Sub_Total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Sub_Total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Sub_Total->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Payment->Required) { ?>
				elm = this.getElements("x" + infix + "_Payment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Payment->caption(), $a_payment_transactions_add->Payment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Payment");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Payment->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Balance->caption(), $a_payment_transactions_add->Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Balance->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Due_Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Due_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Due_Date->caption(), $a_payment_transactions_add->Due_Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Due_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Due_Date->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Date_Transaction->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Transaction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Date_Transaction->caption(), $a_payment_transactions_add->Date_Transaction->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Transaction");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Date_Transaction->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Date_Added->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Date_Added->caption(), $a_payment_transactions_add->Date_Added->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Date_Added->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Added_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Added_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Added_By->caption(), $a_payment_transactions_add->Added_By->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_payment_transactions_add->Date_Updated->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Date_Updated->caption(), $a_payment_transactions_add->Date_Updated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_payment_transactions_add->Date_Updated->errorMessage()) ?>");
			<?php if ($a_payment_transactions_add->Updated_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Updated_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_payment_transactions_add->Updated_By->caption(), $a_payment_transactions_add->Updated_By->RequiredErrorMessage)) ?>");
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
	fa_payment_transactionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fa_payment_transactionsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fa_payment_transactionsadd.lists["x_Type"] = <?php echo $a_payment_transactions_add->Type->Lookup->toClientList($a_payment_transactions_add) ?>;
	fa_payment_transactionsadd.lists["x_Type"].options = <?php echo JsonEncode($a_payment_transactions_add->Type->options(FALSE, TRUE)) ?>;
	loadjs.done("fa_payment_transactionsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_payment_transactions_add->showPageHeader(); ?>
<?php
$a_payment_transactions_add->showMessage();
?>
<form name="fa_payment_transactionsadd" id="fa_payment_transactionsadd" class="<?php echo $a_payment_transactions_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_payment_transactions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$a_payment_transactions_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($a_payment_transactions_add->Ref_ID->Visible) { // Ref_ID ?>
	<div id="r_Ref_ID" class="form-group row">
		<label id="elh_a_payment_transactions_Ref_ID" for="x_Ref_ID" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Ref_ID->caption() ?><?php echo $a_payment_transactions_add->Ref_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Ref_ID->cellAttributes() ?>>
<span id="el_a_payment_transactions_Ref_ID">
<input type="text" data-table="a_payment_transactions" data-field="x_Ref_ID" name="x_Ref_ID" id="x_Ref_ID" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Ref_ID->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Ref_ID->EditValue ?>"<?php echo $a_payment_transactions_add->Ref_ID->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Ref_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Type->Visible) { // Type ?>
	<div id="r_Type" class="form-group row">
		<label id="elh_a_payment_transactions_Type" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Type->caption() ?><?php echo $a_payment_transactions_add->Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Type->cellAttributes() ?>>
<span id="el_a_payment_transactions_Type">
<div id="tp_x_Type" class="ew-template"><input type="radio" class="custom-control-input" data-table="a_payment_transactions" data-field="x_Type" data-value-separator="<?php echo $a_payment_transactions_add->Type->displayValueSeparatorAttribute() ?>" name="x_Type" id="x_Type" value="{value}"<?php echo $a_payment_transactions_add->Type->editAttributes() ?>></div>
<div id="dsl_x_Type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $a_payment_transactions_add->Type->radioButtonListHtml(FALSE, "x_Type") ?>
</div></div>
</span>
<?php echo $a_payment_transactions_add->Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Customer->Visible) { // Customer ?>
	<div id="r_Customer" class="form-group row">
		<label id="elh_a_payment_transactions_Customer" for="x_Customer" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Customer->caption() ?><?php echo $a_payment_transactions_add->Customer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Customer->cellAttributes() ?>>
<span id="el_a_payment_transactions_Customer">
<input type="text" data-table="a_payment_transactions" data-field="x_Customer" name="x_Customer" id="x_Customer" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Customer->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Customer->EditValue ?>"<?php echo $a_payment_transactions_add->Customer->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Customer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label id="elh_a_payment_transactions_Supplier" for="x_Supplier" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Supplier->caption() ?><?php echo $a_payment_transactions_add->Supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Supplier->cellAttributes() ?>>
<span id="el_a_payment_transactions_Supplier">
<input type="text" data-table="a_payment_transactions" data-field="x_Supplier" name="x_Supplier" id="x_Supplier" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Supplier->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Supplier->EditValue ?>"<?php echo $a_payment_transactions_add->Supplier->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Sub_Total->Visible) { // Sub_Total ?>
	<div id="r_Sub_Total" class="form-group row">
		<label id="elh_a_payment_transactions_Sub_Total" for="x_Sub_Total" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Sub_Total->caption() ?><?php echo $a_payment_transactions_add->Sub_Total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Sub_Total->cellAttributes() ?>>
<span id="el_a_payment_transactions_Sub_Total">
<input type="text" data-table="a_payment_transactions" data-field="x_Sub_Total" name="x_Sub_Total" id="x_Sub_Total" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Sub_Total->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Sub_Total->EditValue ?>"<?php echo $a_payment_transactions_add->Sub_Total->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Sub_Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Payment->Visible) { // Payment ?>
	<div id="r_Payment" class="form-group row">
		<label id="elh_a_payment_transactions_Payment" for="x_Payment" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Payment->caption() ?><?php echo $a_payment_transactions_add->Payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Payment->cellAttributes() ?>>
<span id="el_a_payment_transactions_Payment">
<input type="text" data-table="a_payment_transactions" data-field="x_Payment" name="x_Payment" id="x_Payment" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Payment->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Payment->EditValue ?>"<?php echo $a_payment_transactions_add->Payment->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Payment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Balance->Visible) { // Balance ?>
	<div id="r_Balance" class="form-group row">
		<label id="elh_a_payment_transactions_Balance" for="x_Balance" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Balance->caption() ?><?php echo $a_payment_transactions_add->Balance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Balance->cellAttributes() ?>>
<span id="el_a_payment_transactions_Balance">
<input type="text" data-table="a_payment_transactions" data-field="x_Balance" name="x_Balance" id="x_Balance" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Balance->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Balance->EditValue ?>"<?php echo $a_payment_transactions_add->Balance->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Balance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Due_Date->Visible) { // Due_Date ?>
	<div id="r_Due_Date" class="form-group row">
		<label id="elh_a_payment_transactions_Due_Date" for="x_Due_Date" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Due_Date->caption() ?><?php echo $a_payment_transactions_add->Due_Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Due_Date->cellAttributes() ?>>
<span id="el_a_payment_transactions_Due_Date">
<input type="text" data-table="a_payment_transactions" data-field="x_Due_Date" name="x_Due_Date" id="x_Due_Date" maxlength="10" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Due_Date->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Due_Date->EditValue ?>"<?php echo $a_payment_transactions_add->Due_Date->editAttributes() ?>>
<?php if (!$a_payment_transactions_add->Due_Date->ReadOnly && !$a_payment_transactions_add->Due_Date->Disabled && !isset($a_payment_transactions_add->Due_Date->EditAttrs["readonly"]) && !isset($a_payment_transactions_add->Due_Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_payment_transactionsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_payment_transactionsadd", "x_Due_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_payment_transactions_add->Due_Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Date_Transaction->Visible) { // Date_Transaction ?>
	<div id="r_Date_Transaction" class="form-group row">
		<label id="elh_a_payment_transactions_Date_Transaction" for="x_Date_Transaction" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Date_Transaction->caption() ?><?php echo $a_payment_transactions_add->Date_Transaction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Date_Transaction->cellAttributes() ?>>
<span id="el_a_payment_transactions_Date_Transaction">
<input type="text" data-table="a_payment_transactions" data-field="x_Date_Transaction" name="x_Date_Transaction" id="x_Date_Transaction" maxlength="10" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Date_Transaction->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Date_Transaction->EditValue ?>"<?php echo $a_payment_transactions_add->Date_Transaction->editAttributes() ?>>
<?php if (!$a_payment_transactions_add->Date_Transaction->ReadOnly && !$a_payment_transactions_add->Date_Transaction->Disabled && !isset($a_payment_transactions_add->Date_Transaction->EditAttrs["readonly"]) && !isset($a_payment_transactions_add->Date_Transaction->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_payment_transactionsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_payment_transactionsadd", "x_Date_Transaction", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_payment_transactions_add->Date_Transaction->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Date_Added->Visible) { // Date_Added ?>
	<div id="r_Date_Added" class="form-group row">
		<label id="elh_a_payment_transactions_Date_Added" for="x_Date_Added" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Date_Added->caption() ?><?php echo $a_payment_transactions_add->Date_Added->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Date_Added->cellAttributes() ?>>
<span id="el_a_payment_transactions_Date_Added">
<input type="text" data-table="a_payment_transactions" data-field="x_Date_Added" name="x_Date_Added" id="x_Date_Added" maxlength="19" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Date_Added->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Date_Added->EditValue ?>"<?php echo $a_payment_transactions_add->Date_Added->editAttributes() ?>>
<?php if (!$a_payment_transactions_add->Date_Added->ReadOnly && !$a_payment_transactions_add->Date_Added->Disabled && !isset($a_payment_transactions_add->Date_Added->EditAttrs["readonly"]) && !isset($a_payment_transactions_add->Date_Added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_payment_transactionsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_payment_transactionsadd", "x_Date_Added", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_payment_transactions_add->Date_Added->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Added_By->Visible) { // Added_By ?>
	<div id="r_Added_By" class="form-group row">
		<label id="elh_a_payment_transactions_Added_By" for="x_Added_By" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Added_By->caption() ?><?php echo $a_payment_transactions_add->Added_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Added_By->cellAttributes() ?>>
<span id="el_a_payment_transactions_Added_By">
<input type="text" data-table="a_payment_transactions" data-field="x_Added_By" name="x_Added_By" id="x_Added_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Added_By->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Added_By->EditValue ?>"<?php echo $a_payment_transactions_add->Added_By->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Added_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Date_Updated->Visible) { // Date_Updated ?>
	<div id="r_Date_Updated" class="form-group row">
		<label id="elh_a_payment_transactions_Date_Updated" for="x_Date_Updated" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Date_Updated->caption() ?><?php echo $a_payment_transactions_add->Date_Updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Date_Updated->cellAttributes() ?>>
<span id="el_a_payment_transactions_Date_Updated">
<input type="text" data-table="a_payment_transactions" data-field="x_Date_Updated" name="x_Date_Updated" id="x_Date_Updated" maxlength="19" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Date_Updated->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Date_Updated->EditValue ?>"<?php echo $a_payment_transactions_add->Date_Updated->editAttributes() ?>>
<?php if (!$a_payment_transactions_add->Date_Updated->ReadOnly && !$a_payment_transactions_add->Date_Updated->Disabled && !isset($a_payment_transactions_add->Date_Updated->EditAttrs["readonly"]) && !isset($a_payment_transactions_add->Date_Updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_payment_transactionsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_payment_transactionsadd", "x_Date_Updated", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_payment_transactions_add->Date_Updated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_payment_transactions_add->Updated_By->Visible) { // Updated_By ?>
	<div id="r_Updated_By" class="form-group row">
		<label id="elh_a_payment_transactions_Updated_By" for="x_Updated_By" class="<?php echo $a_payment_transactions_add->LeftColumnClass ?>"><?php echo $a_payment_transactions_add->Updated_By->caption() ?><?php echo $a_payment_transactions_add->Updated_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_payment_transactions_add->RightColumnClass ?>"><div <?php echo $a_payment_transactions_add->Updated_By->cellAttributes() ?>>
<span id="el_a_payment_transactions_Updated_By">
<input type="text" data-table="a_payment_transactions" data-field="x_Updated_By" name="x_Updated_By" id="x_Updated_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_payment_transactions_add->Updated_By->getPlaceHolder()) ?>" value="<?php echo $a_payment_transactions_add->Updated_By->EditValue ?>"<?php echo $a_payment_transactions_add->Updated_By->editAttributes() ?>>
</span>
<?php echo $a_payment_transactions_add->Updated_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$a_payment_transactions_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $a_payment_transactions_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_payment_transactions_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$a_payment_transactions_add->showPageFooter();
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
$a_payment_transactions_add->terminate();
?>
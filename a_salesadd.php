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
$a_sales_add = new a_sales_add();

// Run the page
$a_sales_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_sales_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_salesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fa_salesadd = currentForm = new ew.Form("fa_salesadd", "add");

	// Validate form
	fa_salesadd.validate = function() {
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
			<?php if ($a_sales_add->Sales_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Sales_Number->caption(), $a_sales_add->Sales_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Sales_Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Sales_Date->caption(), $a_sales_add->Sales_Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Sales_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Sales_Date->errorMessage()) ?>");
			<?php if ($a_sales_add->Customer_ID->Required) { ?>
				elm = this.getElements("x" + infix + "_Customer_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Customer_ID->caption(), $a_sales_add->Customer_ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Notes->Required) { ?>
				elm = this.getElements("x" + infix + "_Notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Notes->caption(), $a_sales_add->Notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Total_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Total_Amount->caption(), $a_sales_add->Total_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Total_Amount->errorMessage()) ?>");
			<?php if ($a_sales_add->Total_Payment->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Payment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Total_Payment->caption(), $a_sales_add->Total_Payment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Payment");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Total_Payment->errorMessage()) ?>");
			<?php if ($a_sales_add->Total_Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Total_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Total_Balance->caption(), $a_sales_add->Total_Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Total_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Total_Balance->errorMessage()) ?>");
			<?php if ($a_sales_add->Discount_Type->Required) { ?>
				elm = this.getElements("x" + infix + "_Discount_Type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Discount_Type->caption(), $a_sales_add->Discount_Type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Discount_Percentage->Required) { ?>
				elm = this.getElements("x" + infix + "_Discount_Percentage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Discount_Percentage->caption(), $a_sales_add->Discount_Percentage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Discount_Percentage");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Discount_Percentage->errorMessage()) ?>");
			<?php if ($a_sales_add->Discount_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Discount_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Discount_Amount->caption(), $a_sales_add->Discount_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Discount_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Discount_Amount->errorMessage()) ?>");
			<?php if ($a_sales_add->Tax_Percentage->Required) { ?>
				elm = this.getElements("x" + infix + "_Tax_Percentage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Tax_Percentage->caption(), $a_sales_add->Tax_Percentage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tax_Percentage");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Tax_Percentage->errorMessage()) ?>");
			<?php if ($a_sales_add->Tax_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Tax_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Tax_Amount->caption(), $a_sales_add->Tax_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tax_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Tax_Amount->errorMessage()) ?>");
			<?php if ($a_sales_add->Tax_Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Tax_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Tax_Description->caption(), $a_sales_add->Tax_Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Final_Total_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Final_Total_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Final_Total_Amount->caption(), $a_sales_add->Final_Total_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Final_Total_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Final_Total_Amount->errorMessage()) ?>");
			<?php if ($a_sales_add->Date_Added->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Date_Added->caption(), $a_sales_add->Date_Added->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Added");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Date_Added->errorMessage()) ?>");
			<?php if ($a_sales_add->Added_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Added_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Added_By->caption(), $a_sales_add->Added_By->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_add->Date_Updated->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Date_Updated->caption(), $a_sales_add->Date_Updated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Updated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_add->Date_Updated->errorMessage()) ?>");
			<?php if ($a_sales_add->Updated_By->Required) { ?>
				elm = this.getElements("x" + infix + "_Updated_By");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_add->Updated_By->caption(), $a_sales_add->Updated_By->RequiredErrorMessage)) ?>");
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
	fa_salesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fa_salesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fa_salesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_sales_add->showPageHeader(); ?>
<?php
$a_sales_add->showMessage();
?>
<form name="fa_salesadd" id="fa_salesadd" class="<?php echo $a_sales_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_sales">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$a_sales_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($a_sales_add->Sales_Number->Visible) { // Sales_Number ?>
	<div id="r_Sales_Number" class="form-group row">
		<label id="elh_a_sales_Sales_Number" for="x_Sales_Number" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Sales_Number->caption() ?><?php echo $a_sales_add->Sales_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Sales_Number->cellAttributes() ?>>
<span id="el_a_sales_Sales_Number">
<input type="text" data-table="a_sales" data-field="x_Sales_Number" name="x_Sales_Number" id="x_Sales_Number" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_sales_add->Sales_Number->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Sales_Number->EditValue ?>"<?php echo $a_sales_add->Sales_Number->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Sales_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Sales_Date->Visible) { // Sales_Date ?>
	<div id="r_Sales_Date" class="form-group row">
		<label id="elh_a_sales_Sales_Date" for="x_Sales_Date" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Sales_Date->caption() ?><?php echo $a_sales_add->Sales_Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Sales_Date->cellAttributes() ?>>
<span id="el_a_sales_Sales_Date">
<input type="text" data-table="a_sales" data-field="x_Sales_Date" name="x_Sales_Date" id="x_Sales_Date" maxlength="19" placeholder="<?php echo HtmlEncode($a_sales_add->Sales_Date->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Sales_Date->EditValue ?>"<?php echo $a_sales_add->Sales_Date->editAttributes() ?>>
<?php if (!$a_sales_add->Sales_Date->ReadOnly && !$a_sales_add->Sales_Date->Disabled && !isset($a_sales_add->Sales_Date->EditAttrs["readonly"]) && !isset($a_sales_add->Sales_Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_salesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_salesadd", "x_Sales_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_sales_add->Sales_Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Customer_ID->Visible) { // Customer_ID ?>
	<div id="r_Customer_ID" class="form-group row">
		<label id="elh_a_sales_Customer_ID" for="x_Customer_ID" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Customer_ID->caption() ?><?php echo $a_sales_add->Customer_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Customer_ID->cellAttributes() ?>>
<span id="el_a_sales_Customer_ID">
<input type="text" data-table="a_sales" data-field="x_Customer_ID" name="x_Customer_ID" id="x_Customer_ID" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_sales_add->Customer_ID->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Customer_ID->EditValue ?>"<?php echo $a_sales_add->Customer_ID->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Customer_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Notes->Visible) { // Notes ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_a_sales_Notes" for="x_Notes" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Notes->caption() ?><?php echo $a_sales_add->Notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Notes->cellAttributes() ?>>
<span id="el_a_sales_Notes">
<input type="text" data-table="a_sales" data-field="x_Notes" name="x_Notes" id="x_Notes" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_sales_add->Notes->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Notes->EditValue ?>"<?php echo $a_sales_add->Notes->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Total_Amount->Visible) { // Total_Amount ?>
	<div id="r_Total_Amount" class="form-group row">
		<label id="elh_a_sales_Total_Amount" for="x_Total_Amount" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Total_Amount->caption() ?><?php echo $a_sales_add->Total_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Total_Amount->cellAttributes() ?>>
<span id="el_a_sales_Total_Amount">
<input type="text" data-table="a_sales" data-field="x_Total_Amount" name="x_Total_Amount" id="x_Total_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Total_Amount->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Total_Amount->EditValue ?>"<?php echo $a_sales_add->Total_Amount->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Total_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Total_Payment->Visible) { // Total_Payment ?>
	<div id="r_Total_Payment" class="form-group row">
		<label id="elh_a_sales_Total_Payment" for="x_Total_Payment" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Total_Payment->caption() ?><?php echo $a_sales_add->Total_Payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Total_Payment->cellAttributes() ?>>
<span id="el_a_sales_Total_Payment">
<input type="text" data-table="a_sales" data-field="x_Total_Payment" name="x_Total_Payment" id="x_Total_Payment" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Total_Payment->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Total_Payment->EditValue ?>"<?php echo $a_sales_add->Total_Payment->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Total_Payment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Total_Balance->Visible) { // Total_Balance ?>
	<div id="r_Total_Balance" class="form-group row">
		<label id="elh_a_sales_Total_Balance" for="x_Total_Balance" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Total_Balance->caption() ?><?php echo $a_sales_add->Total_Balance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Total_Balance->cellAttributes() ?>>
<span id="el_a_sales_Total_Balance">
<input type="text" data-table="a_sales" data-field="x_Total_Balance" name="x_Total_Balance" id="x_Total_Balance" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Total_Balance->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Total_Balance->EditValue ?>"<?php echo $a_sales_add->Total_Balance->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Total_Balance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Discount_Type->Visible) { // Discount_Type ?>
	<div id="r_Discount_Type" class="form-group row">
		<label id="elh_a_sales_Discount_Type" for="x_Discount_Type" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Discount_Type->caption() ?><?php echo $a_sales_add->Discount_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Discount_Type->cellAttributes() ?>>
<span id="el_a_sales_Discount_Type">
<input type="text" data-table="a_sales" data-field="x_Discount_Type" name="x_Discount_Type" id="x_Discount_Type" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($a_sales_add->Discount_Type->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Discount_Type->EditValue ?>"<?php echo $a_sales_add->Discount_Type->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Discount_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Discount_Percentage->Visible) { // Discount_Percentage ?>
	<div id="r_Discount_Percentage" class="form-group row">
		<label id="elh_a_sales_Discount_Percentage" for="x_Discount_Percentage" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Discount_Percentage->caption() ?><?php echo $a_sales_add->Discount_Percentage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Discount_Percentage->cellAttributes() ?>>
<span id="el_a_sales_Discount_Percentage">
<input type="text" data-table="a_sales" data-field="x_Discount_Percentage" name="x_Discount_Percentage" id="x_Discount_Percentage" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Discount_Percentage->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Discount_Percentage->EditValue ?>"<?php echo $a_sales_add->Discount_Percentage->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Discount_Percentage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Discount_Amount->Visible) { // Discount_Amount ?>
	<div id="r_Discount_Amount" class="form-group row">
		<label id="elh_a_sales_Discount_Amount" for="x_Discount_Amount" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Discount_Amount->caption() ?><?php echo $a_sales_add->Discount_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Discount_Amount->cellAttributes() ?>>
<span id="el_a_sales_Discount_Amount">
<input type="text" data-table="a_sales" data-field="x_Discount_Amount" name="x_Discount_Amount" id="x_Discount_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Discount_Amount->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Discount_Amount->EditValue ?>"<?php echo $a_sales_add->Discount_Amount->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Discount_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Tax_Percentage->Visible) { // Tax_Percentage ?>
	<div id="r_Tax_Percentage" class="form-group row">
		<label id="elh_a_sales_Tax_Percentage" for="x_Tax_Percentage" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Tax_Percentage->caption() ?><?php echo $a_sales_add->Tax_Percentage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Tax_Percentage->cellAttributes() ?>>
<span id="el_a_sales_Tax_Percentage">
<input type="text" data-table="a_sales" data-field="x_Tax_Percentage" name="x_Tax_Percentage" id="x_Tax_Percentage" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Tax_Percentage->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Tax_Percentage->EditValue ?>"<?php echo $a_sales_add->Tax_Percentage->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Tax_Percentage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Tax_Amount->Visible) { // Tax_Amount ?>
	<div id="r_Tax_Amount" class="form-group row">
		<label id="elh_a_sales_Tax_Amount" for="x_Tax_Amount" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Tax_Amount->caption() ?><?php echo $a_sales_add->Tax_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Tax_Amount->cellAttributes() ?>>
<span id="el_a_sales_Tax_Amount">
<input type="text" data-table="a_sales" data-field="x_Tax_Amount" name="x_Tax_Amount" id="x_Tax_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Tax_Amount->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Tax_Amount->EditValue ?>"<?php echo $a_sales_add->Tax_Amount->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Tax_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Tax_Description->Visible) { // Tax_Description ?>
	<div id="r_Tax_Description" class="form-group row">
		<label id="elh_a_sales_Tax_Description" for="x_Tax_Description" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Tax_Description->caption() ?><?php echo $a_sales_add->Tax_Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Tax_Description->cellAttributes() ?>>
<span id="el_a_sales_Tax_Description">
<input type="text" data-table="a_sales" data-field="x_Tax_Description" name="x_Tax_Description" id="x_Tax_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_sales_add->Tax_Description->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Tax_Description->EditValue ?>"<?php echo $a_sales_add->Tax_Description->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Tax_Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Final_Total_Amount->Visible) { // Final_Total_Amount ?>
	<div id="r_Final_Total_Amount" class="form-group row">
		<label id="elh_a_sales_Final_Total_Amount" for="x_Final_Total_Amount" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Final_Total_Amount->caption() ?><?php echo $a_sales_add->Final_Total_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Final_Total_Amount->cellAttributes() ?>>
<span id="el_a_sales_Final_Total_Amount">
<input type="text" data-table="a_sales" data-field="x_Final_Total_Amount" name="x_Final_Total_Amount" id="x_Final_Total_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_add->Final_Total_Amount->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Final_Total_Amount->EditValue ?>"<?php echo $a_sales_add->Final_Total_Amount->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Final_Total_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Date_Added->Visible) { // Date_Added ?>
	<div id="r_Date_Added" class="form-group row">
		<label id="elh_a_sales_Date_Added" for="x_Date_Added" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Date_Added->caption() ?><?php echo $a_sales_add->Date_Added->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Date_Added->cellAttributes() ?>>
<span id="el_a_sales_Date_Added">
<input type="text" data-table="a_sales" data-field="x_Date_Added" name="x_Date_Added" id="x_Date_Added" maxlength="19" placeholder="<?php echo HtmlEncode($a_sales_add->Date_Added->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Date_Added->EditValue ?>"<?php echo $a_sales_add->Date_Added->editAttributes() ?>>
<?php if (!$a_sales_add->Date_Added->ReadOnly && !$a_sales_add->Date_Added->Disabled && !isset($a_sales_add->Date_Added->EditAttrs["readonly"]) && !isset($a_sales_add->Date_Added->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_salesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_salesadd", "x_Date_Added", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_sales_add->Date_Added->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Added_By->Visible) { // Added_By ?>
	<div id="r_Added_By" class="form-group row">
		<label id="elh_a_sales_Added_By" for="x_Added_By" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Added_By->caption() ?><?php echo $a_sales_add->Added_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Added_By->cellAttributes() ?>>
<span id="el_a_sales_Added_By">
<input type="text" data-table="a_sales" data-field="x_Added_By" name="x_Added_By" id="x_Added_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_sales_add->Added_By->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Added_By->EditValue ?>"<?php echo $a_sales_add->Added_By->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Added_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Date_Updated->Visible) { // Date_Updated ?>
	<div id="r_Date_Updated" class="form-group row">
		<label id="elh_a_sales_Date_Updated" for="x_Date_Updated" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Date_Updated->caption() ?><?php echo $a_sales_add->Date_Updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Date_Updated->cellAttributes() ?>>
<span id="el_a_sales_Date_Updated">
<input type="text" data-table="a_sales" data-field="x_Date_Updated" name="x_Date_Updated" id="x_Date_Updated" maxlength="19" placeholder="<?php echo HtmlEncode($a_sales_add->Date_Updated->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Date_Updated->EditValue ?>"<?php echo $a_sales_add->Date_Updated->editAttributes() ?>>
<?php if (!$a_sales_add->Date_Updated->ReadOnly && !$a_sales_add->Date_Updated->Disabled && !isset($a_sales_add->Date_Updated->EditAttrs["readonly"]) && !isset($a_sales_add->Date_Updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fa_salesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fa_salesadd", "x_Date_Updated", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $a_sales_add->Date_Updated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_add->Updated_By->Visible) { // Updated_By ?>
	<div id="r_Updated_By" class="form-group row">
		<label id="elh_a_sales_Updated_By" for="x_Updated_By" class="<?php echo $a_sales_add->LeftColumnClass ?>"><?php echo $a_sales_add->Updated_By->caption() ?><?php echo $a_sales_add->Updated_By->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_add->RightColumnClass ?>"><div <?php echo $a_sales_add->Updated_By->cellAttributes() ?>>
<span id="el_a_sales_Updated_By">
<input type="text" data-table="a_sales" data-field="x_Updated_By" name="x_Updated_By" id="x_Updated_By" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($a_sales_add->Updated_By->getPlaceHolder()) ?>" value="<?php echo $a_sales_add->Updated_By->EditValue ?>"<?php echo $a_sales_add->Updated_By->editAttributes() ?>>
</span>
<?php echo $a_sales_add->Updated_By->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$a_sales_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $a_sales_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_sales_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$a_sales_add->showPageFooter();
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
$a_sales_add->terminate();
?>
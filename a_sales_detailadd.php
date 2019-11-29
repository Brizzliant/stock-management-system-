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
$a_sales_detail_add = new a_sales_detail_add();

// Run the page
$a_sales_detail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_sales_detail_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fa_sales_detailadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fa_sales_detailadd = currentForm = new ew.Form("fa_sales_detailadd", "add");

	// Validate form
	fa_sales_detailadd.validate = function() {
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
			<?php if ($a_sales_detail_add->Sales_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Sales_Number->caption(), $a_sales_detail_add->Sales_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_detail_add->Supplier_Number->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier_Number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Supplier_Number->caption(), $a_sales_detail_add->Supplier_Number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_detail_add->Stock_Item->Required) { ?>
				elm = this.getElements("x" + infix + "_Stock_Item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Stock_Item->caption(), $a_sales_detail_add->Stock_Item->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($a_sales_detail_add->Sales_Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Sales_Quantity->caption(), $a_sales_detail_add->Sales_Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Sales_Quantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_detail_add->Sales_Quantity->errorMessage()) ?>");
			<?php if ($a_sales_detail_add->Purchasing_Price->Required) { ?>
				elm = this.getElements("x" + infix + "_Purchasing_Price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Purchasing_Price->caption(), $a_sales_detail_add->Purchasing_Price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Purchasing_Price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_detail_add->Purchasing_Price->errorMessage()) ?>");
			<?php if ($a_sales_detail_add->Sales_Price->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Sales_Price->caption(), $a_sales_detail_add->Sales_Price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Sales_Price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_detail_add->Sales_Price->errorMessage()) ?>");
			<?php if ($a_sales_detail_add->Sales_Total_Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Sales_Total_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $a_sales_detail_add->Sales_Total_Amount->caption(), $a_sales_detail_add->Sales_Total_Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Sales_Total_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($a_sales_detail_add->Sales_Total_Amount->errorMessage()) ?>");

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
	fa_sales_detailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fa_sales_detailadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fa_sales_detailadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $a_sales_detail_add->showPageHeader(); ?>
<?php
$a_sales_detail_add->showMessage();
?>
<form name="fa_sales_detailadd" id="fa_sales_detailadd" class="<?php echo $a_sales_detail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_sales_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$a_sales_detail_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($a_sales_detail_add->Sales_Number->Visible) { // Sales_Number ?>
	<div id="r_Sales_Number" class="form-group row">
		<label id="elh_a_sales_detail_Sales_Number" for="x_Sales_Number" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Sales_Number->caption() ?><?php echo $a_sales_detail_add->Sales_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Sales_Number->cellAttributes() ?>>
<span id="el_a_sales_detail_Sales_Number">
<input type="text" data-table="a_sales_detail" data-field="x_Sales_Number" name="x_Sales_Number" id="x_Sales_Number" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Sales_Number->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Sales_Number->EditValue ?>"<?php echo $a_sales_detail_add->Sales_Number->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Sales_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Supplier_Number->Visible) { // Supplier_Number ?>
	<div id="r_Supplier_Number" class="form-group row">
		<label id="elh_a_sales_detail_Supplier_Number" for="x_Supplier_Number" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Supplier_Number->caption() ?><?php echo $a_sales_detail_add->Supplier_Number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Supplier_Number->cellAttributes() ?>>
<span id="el_a_sales_detail_Supplier_Number">
<input type="text" data-table="a_sales_detail" data-field="x_Supplier_Number" name="x_Supplier_Number" id="x_Supplier_Number" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Supplier_Number->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Supplier_Number->EditValue ?>"<?php echo $a_sales_detail_add->Supplier_Number->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Supplier_Number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Stock_Item->Visible) { // Stock_Item ?>
	<div id="r_Stock_Item" class="form-group row">
		<label id="elh_a_sales_detail_Stock_Item" for="x_Stock_Item" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Stock_Item->caption() ?><?php echo $a_sales_detail_add->Stock_Item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Stock_Item->cellAttributes() ?>>
<span id="el_a_sales_detail_Stock_Item">
<input type="text" data-table="a_sales_detail" data-field="x_Stock_Item" name="x_Stock_Item" id="x_Stock_Item" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Stock_Item->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Stock_Item->EditValue ?>"<?php echo $a_sales_detail_add->Stock_Item->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Stock_Item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Sales_Quantity->Visible) { // Sales_Quantity ?>
	<div id="r_Sales_Quantity" class="form-group row">
		<label id="elh_a_sales_detail_Sales_Quantity" for="x_Sales_Quantity" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Sales_Quantity->caption() ?><?php echo $a_sales_detail_add->Sales_Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Sales_Quantity->cellAttributes() ?>>
<span id="el_a_sales_detail_Sales_Quantity">
<input type="text" data-table="a_sales_detail" data-field="x_Sales_Quantity" name="x_Sales_Quantity" id="x_Sales_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Sales_Quantity->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Sales_Quantity->EditValue ?>"<?php echo $a_sales_detail_add->Sales_Quantity->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Sales_Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Purchasing_Price->Visible) { // Purchasing_Price ?>
	<div id="r_Purchasing_Price" class="form-group row">
		<label id="elh_a_sales_detail_Purchasing_Price" for="x_Purchasing_Price" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Purchasing_Price->caption() ?><?php echo $a_sales_detail_add->Purchasing_Price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Purchasing_Price->cellAttributes() ?>>
<span id="el_a_sales_detail_Purchasing_Price">
<input type="text" data-table="a_sales_detail" data-field="x_Purchasing_Price" name="x_Purchasing_Price" id="x_Purchasing_Price" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Purchasing_Price->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Purchasing_Price->EditValue ?>"<?php echo $a_sales_detail_add->Purchasing_Price->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Purchasing_Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Sales_Price->Visible) { // Sales_Price ?>
	<div id="r_Sales_Price" class="form-group row">
		<label id="elh_a_sales_detail_Sales_Price" for="x_Sales_Price" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Sales_Price->caption() ?><?php echo $a_sales_detail_add->Sales_Price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Sales_Price->cellAttributes() ?>>
<span id="el_a_sales_detail_Sales_Price">
<input type="text" data-table="a_sales_detail" data-field="x_Sales_Price" name="x_Sales_Price" id="x_Sales_Price" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Sales_Price->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Sales_Price->EditValue ?>"<?php echo $a_sales_detail_add->Sales_Price->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Sales_Price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($a_sales_detail_add->Sales_Total_Amount->Visible) { // Sales_Total_Amount ?>
	<div id="r_Sales_Total_Amount" class="form-group row">
		<label id="elh_a_sales_detail_Sales_Total_Amount" for="x_Sales_Total_Amount" class="<?php echo $a_sales_detail_add->LeftColumnClass ?>"><?php echo $a_sales_detail_add->Sales_Total_Amount->caption() ?><?php echo $a_sales_detail_add->Sales_Total_Amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $a_sales_detail_add->RightColumnClass ?>"><div <?php echo $a_sales_detail_add->Sales_Total_Amount->cellAttributes() ?>>
<span id="el_a_sales_detail_Sales_Total_Amount">
<input type="text" data-table="a_sales_detail" data-field="x_Sales_Total_Amount" name="x_Sales_Total_Amount" id="x_Sales_Total_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($a_sales_detail_add->Sales_Total_Amount->getPlaceHolder()) ?>" value="<?php echo $a_sales_detail_add->Sales_Total_Amount->EditValue ?>"<?php echo $a_sales_detail_add->Sales_Total_Amount->editAttributes() ?>>
</span>
<?php echo $a_sales_detail_add->Sales_Total_Amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$a_sales_detail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $a_sales_detail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $a_sales_detail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$a_sales_detail_add->showPageFooter();
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
$a_sales_detail_add->terminate();
?>
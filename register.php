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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregister, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "register";
	fregister = currentForm = new ew.Form("fregister", "register");

	// Validate form
	fregister.validate = function() {
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
			<?php if ($register->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterUserName"));
			<?php } ?>
			<?php if ($register->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterPassword"));
			<?php } ?>
				if (fobj.c_Password.value != fobj.x_Password.value)
					return this.onError(fobj.c_Password, ew.language.phrase("MismatchPassword"));
			<?php if ($register->First_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_First_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->First_Name->caption(), $register->First_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->Last_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Last_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Last_Name->caption(), $register->Last_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->_Email->caption(), $register->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->User_Level->Required) { ?>
				elm = this.getElements("x" + infix + "_User_Level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->User_Level->caption(), $register->User_Level->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_User_Level");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($register->User_Level->errorMessage()) ?>");
			<?php if ($register->Activated->Required) { ?>
				elm = this.getElements("x" + infix + "_Activated[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Activated->caption(), $register->Activated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Profile->caption(), $register->Profile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->Current_URL->Required) { ?>
				elm = this.getElements("x" + infix + "_Current_URL");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Current_URL->caption(), $register->Current_URL->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->Theme->Required) { ?>
				elm = this.getElements("x" + infix + "_Theme");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Theme->caption(), $register->Theme->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->_Language->Required) { ?>
				elm = this.getElements("x" + infix + "__Language");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->_Language->caption(), $register->_Language->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fregister.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fregister.lists["x_Activated[]"] = <?php echo $register->Activated->Lookup->toClientList($register) ?>;
	fregister.lists["x_Activated[]"].options = <?php echo JsonEncode($register->Activated->options(FALSE, TRUE)) ?>;
	loadjs.done("fregister");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$register->IsModal ?>">
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<?php if ($users->isConfirm()) { // Confirm page ?>
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } ?>
<div class="ew-register-div"><!-- page* -->
<?php if ($register->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_users_Username" for="x_Username" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Username->caption() ?><?php echo $register->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Username->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Username">
<input type="text" data-table="users" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($register->Username->getPlaceHolder()) ?>" value="<?php echo $register->Username->EditValue ?>"<?php echo $register->Username->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_Username">
<span<?php echo $register->Username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Username->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_Username" name="x_Username" id="x_Username" value="<?php echo HtmlEncode($register->Username->FormValue) ?>">
<?php } ?>
<?php echo $register->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_users_Password" for="x_Password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Password->caption() ?><?php echo $register->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Password->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Password">
<input type="text" data-table="users" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="64" placeholder="<?php echo HtmlEncode($register->Password->getPlaceHolder()) ?>" value="<?php echo $register->Password->EditValue ?>"<?php echo $register->Password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_Password">
<span<?php echo $register->Password->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Password->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_Password" name="x_Password" id="x_Password" value="<?php echo HtmlEncode($register->Password->FormValue) ?>">
<?php } ?>
<?php echo $register->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Password->Visible) { // Password ?>
	<div id="r_c_Password" class="form-group row">
		<label id="elh_c_users_Password" for="c_Password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $register->Password->caption() ?><?php echo $register->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Password->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_c_users_Password">
<input type="text" data-table="users" data-field="x_Password" name="c_Password" id="c_Password" size="30" maxlength="64" placeholder="<?php echo HtmlEncode($register->Password->getPlaceHolder()) ?>" value="<?php echo $register->Password->EditValue ?>"<?php echo $register->Password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_users_Password">
<span<?php echo $register->Password->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Password->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_Password" name="c_Password" id="c_Password" value="<?php echo HtmlEncode($register->Password->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } ?>
<?php if ($register->First_Name->Visible) { // First_Name ?>
	<div id="r_First_Name" class="form-group row">
		<label id="elh_users_First_Name" for="x_First_Name" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->First_Name->caption() ?><?php echo $register->First_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->First_Name->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_First_Name">
<input type="text" data-table="users" data-field="x_First_Name" name="x_First_Name" id="x_First_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($register->First_Name->getPlaceHolder()) ?>" value="<?php echo $register->First_Name->EditValue ?>"<?php echo $register->First_Name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_First_Name">
<span<?php echo $register->First_Name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->First_Name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_First_Name" name="x_First_Name" id="x_First_Name" value="<?php echo HtmlEncode($register->First_Name->FormValue) ?>">
<?php } ?>
<?php echo $register->First_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Last_Name->Visible) { // Last_Name ?>
	<div id="r_Last_Name" class="form-group row">
		<label id="elh_users_Last_Name" for="x_Last_Name" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Last_Name->caption() ?><?php echo $register->Last_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Last_Name->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Last_Name">
<input type="text" data-table="users" data-field="x_Last_Name" name="x_Last_Name" id="x_Last_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($register->Last_Name->getPlaceHolder()) ?>" value="<?php echo $register->Last_Name->EditValue ?>"<?php echo $register->Last_Name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_Last_Name">
<span<?php echo $register->Last_Name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Last_Name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_Last_Name" name="x_Last_Name" id="x_Last_Name" value="<?php echo HtmlEncode($register->Last_Name->FormValue) ?>">
<?php } ?>
<?php echo $register->Last_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_users__Email" for="x__Email" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->_Email->caption() ?><?php echo $register->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->_Email->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users__Email">
<input type="text" data-table="users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($register->_Email->getPlaceHolder()) ?>" value="<?php echo $register->_Email->EditValue ?>"<?php echo $register->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users__Email">
<span<?php echo $register->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x__Email" name="x__Email" id="x__Email" value="<?php echo HtmlEncode($register->_Email->FormValue) ?>">
<?php } ?>
<?php echo $register->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->User_Level->Visible) { // User_Level ?>
	<div id="r_User_Level" class="form-group row">
		<label id="elh_users_User_Level" for="x_User_Level" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->User_Level->caption() ?><?php echo $register->User_Level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->User_Level->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_User_Level">
<input type="text" data-table="users" data-field="x_User_Level" name="x_User_Level" id="x_User_Level" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($register->User_Level->getPlaceHolder()) ?>" value="<?php echo $register->User_Level->EditValue ?>"<?php echo $register->User_Level->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_User_Level">
<span<?php echo $register->User_Level->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->User_Level->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_User_Level" name="x_User_Level" id="x_User_Level" value="<?php echo HtmlEncode($register->User_Level->FormValue) ?>">
<?php } ?>
<?php echo $register->User_Level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Activated->Visible) { // Activated ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_users_Activated" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Activated->caption() ?><?php echo $register->Activated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Activated->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Activated">
<?php
$selwrk = ConvertToBool($register->Activated->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $register->Activated->editAttributes() ?>>
	<label class="custom-control-label" for="x_Activated[]"></label>
</div>
</span>
<?php } else { ?>
<span id="el_users_Activated">
<span<?php echo $register->Activated->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_Activated" class="custom-control-input" value="<?php echo $register->Activated->ViewValue ?>" disabled<?php if (ConvertToBool($register->Activated->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_Activated"></label></div></span>
</span>
<input type="hidden" data-table="users" data-field="x_Activated" name="x_Activated" id="x_Activated" value="<?php echo HtmlEncode($register->Activated->FormValue) ?>">
<?php } ?>
<?php echo $register->Activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_users_Profile" for="x_Profile" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Profile->caption() ?><?php echo $register->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Profile->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Profile">
<textarea data-table="users" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($register->Profile->getPlaceHolder()) ?>"<?php echo $register->Profile->editAttributes() ?>><?php echo $register->Profile->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_users_Profile">
<span<?php echo $register->Profile->viewAttributes() ?>><?php echo $register->Profile->ViewValue ?></span>
</span>
<input type="hidden" data-table="users" data-field="x_Profile" name="x_Profile" id="x_Profile" value="<?php echo HtmlEncode($register->Profile->FormValue) ?>">
<?php } ?>
<?php echo $register->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Current_URL->Visible) { // Current_URL ?>
	<div id="r_Current_URL" class="form-group row">
		<label id="elh_users_Current_URL" for="x_Current_URL" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Current_URL->caption() ?><?php echo $register->Current_URL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Current_URL->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Current_URL">
<textarea data-table="users" data-field="x_Current_URL" name="x_Current_URL" id="x_Current_URL" cols="35" rows="4" placeholder="<?php echo HtmlEncode($register->Current_URL->getPlaceHolder()) ?>"<?php echo $register->Current_URL->editAttributes() ?>><?php echo $register->Current_URL->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_users_Current_URL">
<span<?php echo $register->Current_URL->viewAttributes() ?>><?php echo $register->Current_URL->ViewValue ?></span>
</span>
<input type="hidden" data-table="users" data-field="x_Current_URL" name="x_Current_URL" id="x_Current_URL" value="<?php echo HtmlEncode($register->Current_URL->FormValue) ?>">
<?php } ?>
<?php echo $register->Current_URL->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->Theme->Visible) { // Theme ?>
	<div id="r_Theme" class="form-group row">
		<label id="elh_users_Theme" for="x_Theme" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->Theme->caption() ?><?php echo $register->Theme->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Theme->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_Theme">
<input type="text" data-table="users" data-field="x_Theme" name="x_Theme" id="x_Theme" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($register->Theme->getPlaceHolder()) ?>" value="<?php echo $register->Theme->EditValue ?>"<?php echo $register->Theme->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_Theme">
<span<?php echo $register->Theme->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Theme->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_Theme" name="x_Theme" id="x_Theme" value="<?php echo HtmlEncode($register->Theme->FormValue) ?>">
<?php } ?>
<?php echo $register->Theme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->_Language->Visible) { // Language ?>
	<div id="r__Language" class="form-group row">
		<label id="elh_users__Language" for="x__Language" class="<?php echo $register->LeftColumnClass ?>"><?php echo $register->_Language->caption() ?><?php echo $register->_Language->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->_Language->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users__Language">
<input type="text" data-table="users" data-field="x__Language" name="x__Language" id="x__Language" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($register->_Language->getPlaceHolder()) ?>" value="<?php echo $register->_Language->EditValue ?>"<?php echo $register->_Language->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users__Language">
<span<?php echo $register->_Language->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->_Language->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x__Language" name="x__Language" id="x__Language" value="<?php echo HtmlEncode($register->_Language->FormValue) ?>">
<?php } ?>
<?php echo $register->_Language->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$register->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$users->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$register->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$register->terminate();
?>
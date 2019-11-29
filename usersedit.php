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
$users_edit = new users_edit();

// Run the page
$users_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusersedit = currentForm = new ew.Form("fusersedit", "edit");

	// Validate form
	fusersedit.validate = function() {
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
			<?php if ($users_edit->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Username->caption(), $users_edit->Username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Password->caption(), $users_edit->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->First_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_First_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->First_Name->caption(), $users_edit->First_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Last_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Last_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Last_Name->caption(), $users_edit->Last_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->_Email->caption(), $users_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->User_Level->Required) { ?>
				elm = this.getElements("x" + infix + "_User_Level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->User_Level->caption(), $users_edit->User_Level->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_User_Level");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_edit->User_Level->errorMessage()) ?>");
			<?php if ($users_edit->Report_To->Required) { ?>
				elm = this.getElements("x" + infix + "_Report_To");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Report_To->caption(), $users_edit->Report_To->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Report_To");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_edit->Report_To->errorMessage()) ?>");
			<?php if ($users_edit->Activated->Required) { ?>
				elm = this.getElements("x" + infix + "_Activated[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Activated->caption(), $users_edit->Activated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Locked->Required) { ?>
				elm = this.getElements("x" + infix + "_Locked[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Locked->caption(), $users_edit->Locked->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Profile->caption(), $users_edit->Profile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Current_URL->Required) { ?>
				elm = this.getElements("x" + infix + "_Current_URL");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Current_URL->caption(), $users_edit->Current_URL->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Theme->Required) { ?>
				elm = this.getElements("x" + infix + "_Theme");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Theme->caption(), $users_edit->Theme->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Menu_Horizontal->Required) { ?>
				elm = this.getElements("x" + infix + "_Menu_Horizontal[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Menu_Horizontal->caption(), $users_edit->Menu_Horizontal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Table_Width_Style->Required) { ?>
				elm = this.getElements("x" + infix + "_Table_Width_Style");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Table_Width_Style->caption(), $users_edit->Table_Width_Style->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Scroll_Table_Width->Required) { ?>
				elm = this.getElements("x" + infix + "_Scroll_Table_Width");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Scroll_Table_Width->caption(), $users_edit->Scroll_Table_Width->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Scroll_Table_Width");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_edit->Scroll_Table_Width->errorMessage()) ?>");
			<?php if ($users_edit->Scroll_Table_Height->Required) { ?>
				elm = this.getElements("x" + infix + "_Scroll_Table_Height");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Scroll_Table_Height->caption(), $users_edit->Scroll_Table_Height->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Scroll_Table_Height");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_edit->Scroll_Table_Height->errorMessage()) ?>");
			<?php if ($users_edit->Rows_Vertical_Align_Top->Required) { ?>
				elm = this.getElements("x" + infix + "_Rows_Vertical_Align_Top[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Rows_Vertical_Align_Top->caption(), $users_edit->Rows_Vertical_Align_Top->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->_Language->Required) { ?>
				elm = this.getElements("x" + infix + "__Language");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->_Language->caption(), $users_edit->_Language->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Redirect_To_Last_Visited_Page_After_Login->Required) { ?>
				elm = this.getElements("x" + infix + "_Redirect_To_Last_Visited_Page_After_Login[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Redirect_To_Last_Visited_Page_After_Login->caption(), $users_edit->Redirect_To_Last_Visited_Page_After_Login->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Font_Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Font_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Font_Name->caption(), $users_edit->Font_Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Font_Size->Required) { ?>
				elm = this.getElements("x" + infix + "_Font_Size");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Font_Size->caption(), $users_edit->Font_Size->RequiredErrorMessage)) ?>");
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
	fusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersedit.lists["x_Activated[]"] = <?php echo $users_edit->Activated->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Activated[]"].options = <?php echo JsonEncode($users_edit->Activated->options(FALSE, TRUE)) ?>;
	fusersedit.lists["x_Locked[]"] = <?php echo $users_edit->Locked->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Locked[]"].options = <?php echo JsonEncode($users_edit->Locked->options(FALSE, TRUE)) ?>;
	fusersedit.lists["x_Menu_Horizontal[]"] = <?php echo $users_edit->Menu_Horizontal->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Menu_Horizontal[]"].options = <?php echo JsonEncode($users_edit->Menu_Horizontal->options(FALSE, TRUE)) ?>;
	fusersedit.lists["x_Table_Width_Style"] = <?php echo $users_edit->Table_Width_Style->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Table_Width_Style"].options = <?php echo JsonEncode($users_edit->Table_Width_Style->options(FALSE, TRUE)) ?>;
	fusersedit.lists["x_Rows_Vertical_Align_Top[]"] = <?php echo $users_edit->Rows_Vertical_Align_Top->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Rows_Vertical_Align_Top[]"].options = <?php echo JsonEncode($users_edit->Rows_Vertical_Align_Top->options(FALSE, TRUE)) ?>;
	fusersedit.lists["x_Redirect_To_Last_Visited_Page_After_Login[]"] = <?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_Redirect_To_Last_Visited_Page_After_Login[]"].options = <?php echo JsonEncode($users_edit->Redirect_To_Last_Visited_Page_After_Login->options(FALSE, TRUE)) ?>;
	loadjs.done("fusersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_edit->showPageHeader(); ?>
<?php
$users_edit->showMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$users_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($users_edit->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_users_Username" for="x_Username" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Username->caption() ?><?php echo $users_edit->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Username->cellAttributes() ?>>
<input type="text" data-table="users" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($users_edit->Username->getPlaceHolder()) ?>" value="<?php echo $users_edit->Username->EditValue ?>"<?php echo $users_edit->Username->editAttributes() ?>>
<input type="hidden" data-table="users" data-field="x_Username" name="o_Username" id="o_Username" value="<?php echo HtmlEncode($users_edit->Username->OldValue != null ? $users_edit->Username->OldValue : $users_edit->Username->CurrentValue) ?>">
<?php echo $users_edit->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_users_Password" for="x_Password" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Password->caption() ?><?php echo $users_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Password->cellAttributes() ?>>
<span id="el_users_Password">
<input type="text" data-table="users" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="64" placeholder="<?php echo HtmlEncode($users_edit->Password->getPlaceHolder()) ?>" value="<?php echo $users_edit->Password->EditValue ?>"<?php echo $users_edit->Password->editAttributes() ?>>
</span>
<?php echo $users_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->First_Name->Visible) { // First_Name ?>
	<div id="r_First_Name" class="form-group row">
		<label id="elh_users_First_Name" for="x_First_Name" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->First_Name->caption() ?><?php echo $users_edit->First_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->First_Name->cellAttributes() ?>>
<span id="el_users_First_Name">
<input type="text" data-table="users" data-field="x_First_Name" name="x_First_Name" id="x_First_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($users_edit->First_Name->getPlaceHolder()) ?>" value="<?php echo $users_edit->First_Name->EditValue ?>"<?php echo $users_edit->First_Name->editAttributes() ?>>
</span>
<?php echo $users_edit->First_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Last_Name->Visible) { // Last_Name ?>
	<div id="r_Last_Name" class="form-group row">
		<label id="elh_users_Last_Name" for="x_Last_Name" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Last_Name->caption() ?><?php echo $users_edit->Last_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Last_Name->cellAttributes() ?>>
<span id="el_users_Last_Name">
<input type="text" data-table="users" data-field="x_Last_Name" name="x_Last_Name" id="x_Last_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($users_edit->Last_Name->getPlaceHolder()) ?>" value="<?php echo $users_edit->Last_Name->EditValue ?>"<?php echo $users_edit->Last_Name->editAttributes() ?>>
</span>
<?php echo $users_edit->Last_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_users__Email" for="x__Email" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->_Email->caption() ?><?php echo $users_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->_Email->cellAttributes() ?>>
<span id="el_users__Email">
<input type="text" data-table="users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $users_edit->_Email->EditValue ?>"<?php echo $users_edit->_Email->editAttributes() ?>>
</span>
<?php echo $users_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->User_Level->Visible) { // User_Level ?>
	<div id="r_User_Level" class="form-group row">
		<label id="elh_users_User_Level" for="x_User_Level" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->User_Level->caption() ?><?php echo $users_edit->User_Level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->User_Level->cellAttributes() ?>>
<span id="el_users_User_Level">
<input type="text" data-table="users" data-field="x_User_Level" name="x_User_Level" id="x_User_Level" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_edit->User_Level->getPlaceHolder()) ?>" value="<?php echo $users_edit->User_Level->EditValue ?>"<?php echo $users_edit->User_Level->editAttributes() ?>>
</span>
<?php echo $users_edit->User_Level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Report_To->Visible) { // Report_To ?>
	<div id="r_Report_To" class="form-group row">
		<label id="elh_users_Report_To" for="x_Report_To" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Report_To->caption() ?><?php echo $users_edit->Report_To->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Report_To->cellAttributes() ?>>
<span id="el_users_Report_To">
<input type="text" data-table="users" data-field="x_Report_To" name="x_Report_To" id="x_Report_To" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_edit->Report_To->getPlaceHolder()) ?>" value="<?php echo $users_edit->Report_To->EditValue ?>"<?php echo $users_edit->Report_To->editAttributes() ?>>
</span>
<?php echo $users_edit->Report_To->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Activated->Visible) { // Activated ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_users_Activated" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Activated->caption() ?><?php echo $users_edit->Activated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Activated->cellAttributes() ?>>
<span id="el_users_Activated">
<?php
$selwrk = ConvertToBool($users_edit->Activated->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Activated" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $users_edit->Activated->editAttributes() ?>>
	<label class="custom-control-label" for="x_Activated[]"></label>
</div>
</span>
<?php echo $users_edit->Activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Locked->Visible) { // Locked ?>
	<div id="r_Locked" class="form-group row">
		<label id="elh_users_Locked" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Locked->caption() ?><?php echo $users_edit->Locked->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Locked->cellAttributes() ?>>
<span id="el_users_Locked">
<?php
$selwrk = ConvertToBool($users_edit->Locked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Locked" name="x_Locked[]" id="x_Locked[]" value="1"<?php echo $selwrk ?><?php echo $users_edit->Locked->editAttributes() ?>>
	<label class="custom-control-label" for="x_Locked[]"></label>
</div>
</span>
<?php echo $users_edit->Locked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_users_Profile" for="x_Profile" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Profile->caption() ?><?php echo $users_edit->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Profile->cellAttributes() ?>>
<span id="el_users_Profile">
<textarea data-table="users" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($users_edit->Profile->getPlaceHolder()) ?>"<?php echo $users_edit->Profile->editAttributes() ?>><?php echo $users_edit->Profile->EditValue ?></textarea>
</span>
<?php echo $users_edit->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Current_URL->Visible) { // Current_URL ?>
	<div id="r_Current_URL" class="form-group row">
		<label id="elh_users_Current_URL" for="x_Current_URL" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Current_URL->caption() ?><?php echo $users_edit->Current_URL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Current_URL->cellAttributes() ?>>
<span id="el_users_Current_URL">
<textarea data-table="users" data-field="x_Current_URL" name="x_Current_URL" id="x_Current_URL" cols="35" rows="4" placeholder="<?php echo HtmlEncode($users_edit->Current_URL->getPlaceHolder()) ?>"<?php echo $users_edit->Current_URL->editAttributes() ?>><?php echo $users_edit->Current_URL->EditValue ?></textarea>
</span>
<?php echo $users_edit->Current_URL->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Theme->Visible) { // Theme ?>
	<div id="r_Theme" class="form-group row">
		<label id="elh_users_Theme" for="x_Theme" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Theme->caption() ?><?php echo $users_edit->Theme->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Theme->cellAttributes() ?>>
<span id="el_users_Theme">
<input type="text" data-table="users" data-field="x_Theme" name="x_Theme" id="x_Theme" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($users_edit->Theme->getPlaceHolder()) ?>" value="<?php echo $users_edit->Theme->EditValue ?>"<?php echo $users_edit->Theme->editAttributes() ?>>
</span>
<?php echo $users_edit->Theme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Menu_Horizontal->Visible) { // Menu_Horizontal ?>
	<div id="r_Menu_Horizontal" class="form-group row">
		<label id="elh_users_Menu_Horizontal" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Menu_Horizontal->caption() ?><?php echo $users_edit->Menu_Horizontal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Menu_Horizontal->cellAttributes() ?>>
<span id="el_users_Menu_Horizontal">
<?php
$selwrk = ConvertToBool($users_edit->Menu_Horizontal->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Menu_Horizontal" name="x_Menu_Horizontal[]" id="x_Menu_Horizontal[]" value="1"<?php echo $selwrk ?><?php echo $users_edit->Menu_Horizontal->editAttributes() ?>>
	<label class="custom-control-label" for="x_Menu_Horizontal[]"></label>
</div>
</span>
<?php echo $users_edit->Menu_Horizontal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Table_Width_Style->Visible) { // Table_Width_Style ?>
	<div id="r_Table_Width_Style" class="form-group row">
		<label id="elh_users_Table_Width_Style" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Table_Width_Style->caption() ?><?php echo $users_edit->Table_Width_Style->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Table_Width_Style->cellAttributes() ?>>
<span id="el_users_Table_Width_Style">
<div id="tp_x_Table_Width_Style" class="ew-template"><input type="radio" class="custom-control-input" data-table="users" data-field="x_Table_Width_Style" data-value-separator="<?php echo $users_edit->Table_Width_Style->displayValueSeparatorAttribute() ?>" name="x_Table_Width_Style" id="x_Table_Width_Style" value="{value}"<?php echo $users_edit->Table_Width_Style->editAttributes() ?>></div>
<div id="dsl_x_Table_Width_Style" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $users_edit->Table_Width_Style->radioButtonListHtml(FALSE, "x_Table_Width_Style") ?>
</div></div>
</span>
<?php echo $users_edit->Table_Width_Style->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Scroll_Table_Width->Visible) { // Scroll_Table_Width ?>
	<div id="r_Scroll_Table_Width" class="form-group row">
		<label id="elh_users_Scroll_Table_Width" for="x_Scroll_Table_Width" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Scroll_Table_Width->caption() ?><?php echo $users_edit->Scroll_Table_Width->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Scroll_Table_Width->cellAttributes() ?>>
<span id="el_users_Scroll_Table_Width">
<input type="text" data-table="users" data-field="x_Scroll_Table_Width" name="x_Scroll_Table_Width" id="x_Scroll_Table_Width" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_edit->Scroll_Table_Width->getPlaceHolder()) ?>" value="<?php echo $users_edit->Scroll_Table_Width->EditValue ?>"<?php echo $users_edit->Scroll_Table_Width->editAttributes() ?>>
</span>
<?php echo $users_edit->Scroll_Table_Width->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Scroll_Table_Height->Visible) { // Scroll_Table_Height ?>
	<div id="r_Scroll_Table_Height" class="form-group row">
		<label id="elh_users_Scroll_Table_Height" for="x_Scroll_Table_Height" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Scroll_Table_Height->caption() ?><?php echo $users_edit->Scroll_Table_Height->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Scroll_Table_Height->cellAttributes() ?>>
<span id="el_users_Scroll_Table_Height">
<input type="text" data-table="users" data-field="x_Scroll_Table_Height" name="x_Scroll_Table_Height" id="x_Scroll_Table_Height" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_edit->Scroll_Table_Height->getPlaceHolder()) ?>" value="<?php echo $users_edit->Scroll_Table_Height->EditValue ?>"<?php echo $users_edit->Scroll_Table_Height->editAttributes() ?>>
</span>
<?php echo $users_edit->Scroll_Table_Height->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Rows_Vertical_Align_Top->Visible) { // Rows_Vertical_Align_Top ?>
	<div id="r_Rows_Vertical_Align_Top" class="form-group row">
		<label id="elh_users_Rows_Vertical_Align_Top" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Rows_Vertical_Align_Top->caption() ?><?php echo $users_edit->Rows_Vertical_Align_Top->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Rows_Vertical_Align_Top->cellAttributes() ?>>
<span id="el_users_Rows_Vertical_Align_Top">
<?php
$selwrk = ConvertToBool($users_edit->Rows_Vertical_Align_Top->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Rows_Vertical_Align_Top" name="x_Rows_Vertical_Align_Top[]" id="x_Rows_Vertical_Align_Top[]" value="1"<?php echo $selwrk ?><?php echo $users_edit->Rows_Vertical_Align_Top->editAttributes() ?>>
	<label class="custom-control-label" for="x_Rows_Vertical_Align_Top[]"></label>
</div>
</span>
<?php echo $users_edit->Rows_Vertical_Align_Top->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->_Language->Visible) { // Language ?>
	<div id="r__Language" class="form-group row">
		<label id="elh_users__Language" for="x__Language" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->_Language->caption() ?><?php echo $users_edit->_Language->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->_Language->cellAttributes() ?>>
<span id="el_users__Language">
<input type="text" data-table="users" data-field="x__Language" name="x__Language" id="x__Language" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($users_edit->_Language->getPlaceHolder()) ?>" value="<?php echo $users_edit->_Language->EditValue ?>"<?php echo $users_edit->_Language->editAttributes() ?>>
</span>
<?php echo $users_edit->_Language->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Redirect_To_Last_Visited_Page_After_Login->Visible) { // Redirect_To_Last_Visited_Page_After_Login ?>
	<div id="r_Redirect_To_Last_Visited_Page_After_Login" class="form-group row">
		<label id="elh_users_Redirect_To_Last_Visited_Page_After_Login" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->caption() ?><?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->cellAttributes() ?>>
<span id="el_users_Redirect_To_Last_Visited_Page_After_Login">
<?php
$selwrk = ConvertToBool($users_edit->Redirect_To_Last_Visited_Page_After_Login->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="users" data-field="x_Redirect_To_Last_Visited_Page_After_Login" name="x_Redirect_To_Last_Visited_Page_After_Login[]" id="x_Redirect_To_Last_Visited_Page_After_Login[]" value="1"<?php echo $selwrk ?><?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->editAttributes() ?>>
	<label class="custom-control-label" for="x_Redirect_To_Last_Visited_Page_After_Login[]"></label>
</div>
</span>
<?php echo $users_edit->Redirect_To_Last_Visited_Page_After_Login->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Font_Name->Visible) { // Font_Name ?>
	<div id="r_Font_Name" class="form-group row">
		<label id="elh_users_Font_Name" for="x_Font_Name" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Font_Name->caption() ?><?php echo $users_edit->Font_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Font_Name->cellAttributes() ?>>
<span id="el_users_Font_Name">
<input type="text" data-table="users" data-field="x_Font_Name" name="x_Font_Name" id="x_Font_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($users_edit->Font_Name->getPlaceHolder()) ?>" value="<?php echo $users_edit->Font_Name->EditValue ?>"<?php echo $users_edit->Font_Name->editAttributes() ?>>
</span>
<?php echo $users_edit->Font_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Font_Size->Visible) { // Font_Size ?>
	<div id="r_Font_Size" class="form-group row">
		<label id="elh_users_Font_Size" for="x_Font_Size" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Font_Size->caption() ?><?php echo $users_edit->Font_Size->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Font_Size->cellAttributes() ?>>
<span id="el_users_Font_Size">
<input type="text" data-table="users" data-field="x_Font_Size" name="x_Font_Size" id="x_Font_Size" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($users_edit->Font_Size->getPlaceHolder()) ?>" value="<?php echo $users_edit->Font_Size->EditValue ?>"<?php echo $users_edit->Font_Size->editAttributes() ?>>
</span>
<?php echo $users_edit->Font_Size->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_edit->showPageFooter();
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
$users_edit->terminate();
?>
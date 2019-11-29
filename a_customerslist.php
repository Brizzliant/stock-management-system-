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
$a_customers_list = new a_customers_list();

// Run the page
$a_customers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$a_customers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$a_customers_list->isExport()) { ?>
<script>
var fa_customerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fa_customerslist = currentForm = new ew.Form("fa_customerslist", "list");
	fa_customerslist.formKeyCountName = '<?php echo $a_customers_list->FormKeyCountName ?>';
	loadjs.done("fa_customerslist");
});
var fa_customerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fa_customerslistsrch = currentSearchForm = new ew.Form("fa_customerslistsrch");

	// Dynamic selection lists
	// Filters

	fa_customerslistsrch.filterList = <?php echo $a_customers_list->getFilterList() ?>;
	loadjs.done("fa_customerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$a_customers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($a_customers_list->TotalRecords > 0 && $a_customers_list->ExportOptions->visible()) { ?>
<?php $a_customers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($a_customers_list->ImportOptions->visible()) { ?>
<?php $a_customers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($a_customers_list->SearchOptions->visible()) { ?>
<?php $a_customers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($a_customers_list->FilterOptions->visible()) { ?>
<?php $a_customers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$a_customers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$a_customers_list->isExport() && !$a_customers->CurrentAction) { ?>
<form name="fa_customerslistsrch" id="fa_customerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fa_customerslistsrch-search-panel" class="<?php echo $a_customers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="a_customers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $a_customers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($a_customers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($a_customers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $a_customers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($a_customers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($a_customers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($a_customers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($a_customers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $a_customers_list->showPageHeader(); ?>
<?php
$a_customers_list->showMessage();
?>
<?php if ($a_customers_list->TotalRecords > 0 || $a_customers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($a_customers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> a_customers">
<form name="fa_customerslist" id="fa_customerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="a_customers">
<div id="gmp_a_customers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($a_customers_list->TotalRecords > 0 || $a_customers_list->isGridEdit()) { ?>
<table id="tbl_a_customerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$a_customers->RowType = ROWTYPE_HEADER;

// Render list options
$a_customers_list->renderListOptions();

// Render list options (header, left)
$a_customers_list->ListOptions->render("header", "left");
?>
<?php if ($a_customers_list->Customer_ID->Visible) { // Customer_ID ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Customer_ID) == "") { ?>
		<th data-name="Customer_ID" class="<?php echo $a_customers_list->Customer_ID->headerCellClass() ?>"><div id="elh_a_customers_Customer_ID" class="a_customers_Customer_ID"><div class="ew-table-header-caption"><?php echo $a_customers_list->Customer_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Customer_ID" class="<?php echo $a_customers_list->Customer_ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Customer_ID) ?>', 1);"><div id="elh_a_customers_Customer_ID" class="a_customers_Customer_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Customer_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Customer_ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Customer_ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Customer_Number->Visible) { // Customer_Number ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Customer_Number) == "") { ?>
		<th data-name="Customer_Number" class="<?php echo $a_customers_list->Customer_Number->headerCellClass() ?>"><div id="elh_a_customers_Customer_Number" class="a_customers_Customer_Number"><div class="ew-table-header-caption"><?php echo $a_customers_list->Customer_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Customer_Number" class="<?php echo $a_customers_list->Customer_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Customer_Number) ?>', 1);"><div id="elh_a_customers_Customer_Number" class="a_customers_Customer_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Customer_Number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Customer_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Customer_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Customer_Name->Visible) { // Customer_Name ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Customer_Name) == "") { ?>
		<th data-name="Customer_Name" class="<?php echo $a_customers_list->Customer_Name->headerCellClass() ?>"><div id="elh_a_customers_Customer_Name" class="a_customers_Customer_Name"><div class="ew-table-header-caption"><?php echo $a_customers_list->Customer_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Customer_Name" class="<?php echo $a_customers_list->Customer_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Customer_Name) ?>', 1);"><div id="elh_a_customers_Customer_Name" class="a_customers_Customer_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Customer_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Customer_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Customer_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->City->Visible) { // City ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->City) == "") { ?>
		<th data-name="City" class="<?php echo $a_customers_list->City->headerCellClass() ?>"><div id="elh_a_customers_City" class="a_customers_City"><div class="ew-table-header-caption"><?php echo $a_customers_list->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $a_customers_list->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->City) ?>', 1);"><div id="elh_a_customers_City" class="a_customers_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->City->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->City->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Country->Visible) { // Country ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $a_customers_list->Country->headerCellClass() ?>"><div id="elh_a_customers_Country" class="a_customers_Country"><div class="ew-table-header-caption"><?php echo $a_customers_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $a_customers_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Country) ?>', 1);"><div id="elh_a_customers_Country" class="a_customers_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Contact_Person->Visible) { // Contact_Person ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Contact_Person) == "") { ?>
		<th data-name="Contact_Person" class="<?php echo $a_customers_list->Contact_Person->headerCellClass() ?>"><div id="elh_a_customers_Contact_Person" class="a_customers_Contact_Person"><div class="ew-table-header-caption"><?php echo $a_customers_list->Contact_Person->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Contact_Person" class="<?php echo $a_customers_list->Contact_Person->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Contact_Person) ?>', 1);"><div id="elh_a_customers_Contact_Person" class="a_customers_Contact_Person">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Contact_Person->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Contact_Person->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Contact_Person->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Phone_Number->Visible) { // Phone_Number ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Phone_Number) == "") { ?>
		<th data-name="Phone_Number" class="<?php echo $a_customers_list->Phone_Number->headerCellClass() ?>"><div id="elh_a_customers_Phone_Number" class="a_customers_Phone_Number"><div class="ew-table-header-caption"><?php echo $a_customers_list->Phone_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone_Number" class="<?php echo $a_customers_list->Phone_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Phone_Number) ?>', 1);"><div id="elh_a_customers_Phone_Number" class="a_customers_Phone_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Phone_Number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Phone_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Phone_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->_Email->Visible) { // Email ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $a_customers_list->_Email->headerCellClass() ?>"><div id="elh_a_customers__Email" class="a_customers__Email"><div class="ew-table-header-caption"><?php echo $a_customers_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $a_customers_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->_Email) ?>', 1);"><div id="elh_a_customers__Email" class="a_customers__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Mobile_Number->Visible) { // Mobile_Number ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Mobile_Number) == "") { ?>
		<th data-name="Mobile_Number" class="<?php echo $a_customers_list->Mobile_Number->headerCellClass() ?>"><div id="elh_a_customers_Mobile_Number" class="a_customers_Mobile_Number"><div class="ew-table-header-caption"><?php echo $a_customers_list->Mobile_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile_Number" class="<?php echo $a_customers_list->Mobile_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Mobile_Number) ?>', 1);"><div id="elh_a_customers_Mobile_Number" class="a_customers_Mobile_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Mobile_Number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Mobile_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Mobile_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Notes->Visible) { // Notes ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Notes) == "") { ?>
		<th data-name="Notes" class="<?php echo $a_customers_list->Notes->headerCellClass() ?>"><div id="elh_a_customers_Notes" class="a_customers_Notes"><div class="ew-table-header-caption"><?php echo $a_customers_list->Notes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Notes" class="<?php echo $a_customers_list->Notes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Notes) ?>', 1);"><div id="elh_a_customers_Notes" class="a_customers_Notes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Notes->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Notes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Notes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Balance->Visible) { // Balance ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Balance) == "") { ?>
		<th data-name="Balance" class="<?php echo $a_customers_list->Balance->headerCellClass() ?>"><div id="elh_a_customers_Balance" class="a_customers_Balance"><div class="ew-table-header-caption"><?php echo $a_customers_list->Balance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Balance" class="<?php echo $a_customers_list->Balance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Balance) ?>', 1);"><div id="elh_a_customers_Balance" class="a_customers_Balance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Balance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Balance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Date_Added->Visible) { // Date_Added ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Date_Added) == "") { ?>
		<th data-name="Date_Added" class="<?php echo $a_customers_list->Date_Added->headerCellClass() ?>"><div id="elh_a_customers_Date_Added" class="a_customers_Date_Added"><div class="ew-table-header-caption"><?php echo $a_customers_list->Date_Added->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date_Added" class="<?php echo $a_customers_list->Date_Added->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Date_Added) ?>', 1);"><div id="elh_a_customers_Date_Added" class="a_customers_Date_Added">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Date_Added->caption() ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Date_Added->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Date_Added->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Added_By->Visible) { // Added_By ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Added_By) == "") { ?>
		<th data-name="Added_By" class="<?php echo $a_customers_list->Added_By->headerCellClass() ?>"><div id="elh_a_customers_Added_By" class="a_customers_Added_By"><div class="ew-table-header-caption"><?php echo $a_customers_list->Added_By->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Added_By" class="<?php echo $a_customers_list->Added_By->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Added_By) ?>', 1);"><div id="elh_a_customers_Added_By" class="a_customers_Added_By">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Added_By->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Added_By->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Added_By->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Date_Updated->Visible) { // Date_Updated ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Date_Updated) == "") { ?>
		<th data-name="Date_Updated" class="<?php echo $a_customers_list->Date_Updated->headerCellClass() ?>"><div id="elh_a_customers_Date_Updated" class="a_customers_Date_Updated"><div class="ew-table-header-caption"><?php echo $a_customers_list->Date_Updated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date_Updated" class="<?php echo $a_customers_list->Date_Updated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Date_Updated) ?>', 1);"><div id="elh_a_customers_Date_Updated" class="a_customers_Date_Updated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Date_Updated->caption() ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Date_Updated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Date_Updated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($a_customers_list->Updated_By->Visible) { // Updated_By ?>
	<?php if ($a_customers_list->SortUrl($a_customers_list->Updated_By) == "") { ?>
		<th data-name="Updated_By" class="<?php echo $a_customers_list->Updated_By->headerCellClass() ?>"><div id="elh_a_customers_Updated_By" class="a_customers_Updated_By"><div class="ew-table-header-caption"><?php echo $a_customers_list->Updated_By->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Updated_By" class="<?php echo $a_customers_list->Updated_By->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $a_customers_list->SortUrl($a_customers_list->Updated_By) ?>', 1);"><div id="elh_a_customers_Updated_By" class="a_customers_Updated_By">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $a_customers_list->Updated_By->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($a_customers_list->Updated_By->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($a_customers_list->Updated_By->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$a_customers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($a_customers_list->ExportAll && $a_customers_list->isExport()) {
	$a_customers_list->StopRecord = $a_customers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($a_customers_list->TotalRecords > $a_customers_list->StartRecord + $a_customers_list->DisplayRecords - 1)
		$a_customers_list->StopRecord = $a_customers_list->StartRecord + $a_customers_list->DisplayRecords - 1;
	else
		$a_customers_list->StopRecord = $a_customers_list->TotalRecords;
}
$a_customers_list->RecordCount = $a_customers_list->StartRecord - 1;
if ($a_customers_list->Recordset && !$a_customers_list->Recordset->EOF) {
	$a_customers_list->Recordset->moveFirst();
	$selectLimit = $a_customers_list->UseSelectLimit;
	if (!$selectLimit && $a_customers_list->StartRecord > 1)
		$a_customers_list->Recordset->move($a_customers_list->StartRecord - 1);
} elseif (!$a_customers->AllowAddDeleteRow && $a_customers_list->StopRecord == 0) {
	$a_customers_list->StopRecord = $a_customers->GridAddRowCount;
}

// Initialize aggregate
$a_customers->RowType = ROWTYPE_AGGREGATEINIT;
$a_customers->resetAttributes();
$a_customers_list->renderRow();
while ($a_customers_list->RecordCount < $a_customers_list->StopRecord) {
	$a_customers_list->RecordCount++;
	if ($a_customers_list->RecordCount >= $a_customers_list->StartRecord) {
		$a_customers_list->RowCount++;

		// Set up key count
		$a_customers_list->KeyCount = $a_customers_list->RowIndex;

		// Init row class and style
		$a_customers->resetAttributes();
		$a_customers->CssClass = "";
		if ($a_customers_list->isGridAdd()) {
		} else {
			$a_customers_list->loadRowValues($a_customers_list->Recordset); // Load row values
		}
		$a_customers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$a_customers->RowAttrs->merge(["data-rowindex" => $a_customers_list->RowCount, "id" => "r" . $a_customers_list->RowCount . "_a_customers", "data-rowtype" => $a_customers->RowType]);

		// Render row
		$a_customers_list->renderRow();

		// Render list options
		$a_customers_list->renderListOptions();
?>
	<tr <?php echo $a_customers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$a_customers_list->ListOptions->render("body", "left", $a_customers_list->RowCount);
?>
	<?php if ($a_customers_list->Customer_ID->Visible) { // Customer_ID ?>
		<td data-name="Customer_ID" <?php echo $a_customers_list->Customer_ID->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Customer_ID">
<span<?php echo $a_customers_list->Customer_ID->viewAttributes() ?>><?php echo $a_customers_list->Customer_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Customer_Number->Visible) { // Customer_Number ?>
		<td data-name="Customer_Number" <?php echo $a_customers_list->Customer_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Customer_Number">
<span<?php echo $a_customers_list->Customer_Number->viewAttributes() ?>><?php echo $a_customers_list->Customer_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Customer_Name->Visible) { // Customer_Name ?>
		<td data-name="Customer_Name" <?php echo $a_customers_list->Customer_Name->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Customer_Name">
<span<?php echo $a_customers_list->Customer_Name->viewAttributes() ?>><?php echo $a_customers_list->Customer_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->City->Visible) { // City ?>
		<td data-name="City" <?php echo $a_customers_list->City->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_City">
<span<?php echo $a_customers_list->City->viewAttributes() ?>><?php echo $a_customers_list->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $a_customers_list->Country->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Country">
<span<?php echo $a_customers_list->Country->viewAttributes() ?>><?php echo $a_customers_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Contact_Person->Visible) { // Contact_Person ?>
		<td data-name="Contact_Person" <?php echo $a_customers_list->Contact_Person->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Contact_Person">
<span<?php echo $a_customers_list->Contact_Person->viewAttributes() ?>><?php echo $a_customers_list->Contact_Person->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Phone_Number->Visible) { // Phone_Number ?>
		<td data-name="Phone_Number" <?php echo $a_customers_list->Phone_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Phone_Number">
<span<?php echo $a_customers_list->Phone_Number->viewAttributes() ?>><?php echo $a_customers_list->Phone_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $a_customers_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers__Email">
<span<?php echo $a_customers_list->_Email->viewAttributes() ?>><?php echo $a_customers_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Mobile_Number->Visible) { // Mobile_Number ?>
		<td data-name="Mobile_Number" <?php echo $a_customers_list->Mobile_Number->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Mobile_Number">
<span<?php echo $a_customers_list->Mobile_Number->viewAttributes() ?>><?php echo $a_customers_list->Mobile_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Notes->Visible) { // Notes ?>
		<td data-name="Notes" <?php echo $a_customers_list->Notes->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Notes">
<span<?php echo $a_customers_list->Notes->viewAttributes() ?>><?php echo $a_customers_list->Notes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" <?php echo $a_customers_list->Balance->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Balance">
<span<?php echo $a_customers_list->Balance->viewAttributes() ?>><?php echo $a_customers_list->Balance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Date_Added->Visible) { // Date_Added ?>
		<td data-name="Date_Added" <?php echo $a_customers_list->Date_Added->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Date_Added">
<span<?php echo $a_customers_list->Date_Added->viewAttributes() ?>><?php echo $a_customers_list->Date_Added->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Added_By->Visible) { // Added_By ?>
		<td data-name="Added_By" <?php echo $a_customers_list->Added_By->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Added_By">
<span<?php echo $a_customers_list->Added_By->viewAttributes() ?>><?php echo $a_customers_list->Added_By->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Date_Updated->Visible) { // Date_Updated ?>
		<td data-name="Date_Updated" <?php echo $a_customers_list->Date_Updated->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Date_Updated">
<span<?php echo $a_customers_list->Date_Updated->viewAttributes() ?>><?php echo $a_customers_list->Date_Updated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($a_customers_list->Updated_By->Visible) { // Updated_By ?>
		<td data-name="Updated_By" <?php echo $a_customers_list->Updated_By->cellAttributes() ?>>
<span id="el<?php echo $a_customers_list->RowCount ?>_a_customers_Updated_By">
<span<?php echo $a_customers_list->Updated_By->viewAttributes() ?>><?php echo $a_customers_list->Updated_By->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$a_customers_list->ListOptions->render("body", "right", $a_customers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$a_customers_list->isGridAdd())
		$a_customers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$a_customers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($a_customers_list->Recordset)
	$a_customers_list->Recordset->Close();
?>
<?php if (!$a_customers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$a_customers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $a_customers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $a_customers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($a_customers_list->TotalRecords == 0 && !$a_customers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $a_customers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$a_customers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$a_customers_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$a_customers_list->terminate();
?>
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
$view_sales_details_list = new view_sales_details_list();

// Run the page
$view_sales_details_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_sales_details_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view_sales_details_list->isExport()) { ?>
<script>
var fview_sales_detailslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview_sales_detailslist = currentForm = new ew.Form("fview_sales_detailslist", "list");
	fview_sales_detailslist.formKeyCountName = '<?php echo $view_sales_details_list->FormKeyCountName ?>';
	loadjs.done("fview_sales_detailslist");
});
var fview_sales_detailslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview_sales_detailslistsrch = currentSearchForm = new ew.Form("fview_sales_detailslistsrch");

	// Dynamic selection lists
	// Filters

	fview_sales_detailslistsrch.filterList = <?php echo $view_sales_details_list->getFilterList() ?>;
	loadjs.done("fview_sales_detailslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$view_sales_details_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view_sales_details_list->TotalRecords > 0 && $view_sales_details_list->ExportOptions->visible()) { ?>
<?php $view_sales_details_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view_sales_details_list->ImportOptions->visible()) { ?>
<?php $view_sales_details_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view_sales_details_list->SearchOptions->visible()) { ?>
<?php $view_sales_details_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view_sales_details_list->FilterOptions->visible()) { ?>
<?php $view_sales_details_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view_sales_details_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view_sales_details_list->isExport() && !$view_sales_details->CurrentAction) { ?>
<form name="fview_sales_detailslistsrch" id="fview_sales_detailslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview_sales_detailslistsrch-search-panel" class="<?php echo $view_sales_details_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_sales_details">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view_sales_details_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view_sales_details_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view_sales_details_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view_sales_details_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view_sales_details_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view_sales_details_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view_sales_details_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view_sales_details_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view_sales_details_list->showPageHeader(); ?>
<?php
$view_sales_details_list->showMessage();
?>
<?php if ($view_sales_details_list->TotalRecords > 0 || $view_sales_details->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view_sales_details_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view_sales_details">
<form name="fview_sales_detailslist" id="fview_sales_detailslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_sales_details">
<div id="gmp_view_sales_details" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view_sales_details_list->TotalRecords > 0 || $view_sales_details_list->isGridEdit()) { ?>
<table id="tbl_view_sales_detailslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view_sales_details->RowType = ROWTYPE_HEADER;

// Render list options
$view_sales_details_list->renderListOptions();

// Render list options (header, left)
$view_sales_details_list->ListOptions->render("header", "left");
?>
<?php if ($view_sales_details_list->Sales_ID->Visible) { // Sales_ID ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Sales_ID) == "") { ?>
		<th data-name="Sales_ID" class="<?php echo $view_sales_details_list->Sales_ID->headerCellClass() ?>"><div id="elh_view_sales_details_Sales_ID" class="view_sales_details_Sales_ID"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sales_ID" class="<?php echo $view_sales_details_list->Sales_ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Sales_ID) ?>', 1);"><div id="elh_view_sales_details_Sales_ID" class="view_sales_details_Sales_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Sales_ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Sales_ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Sales_Number->Visible) { // Sales_Number ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Sales_Number) == "") { ?>
		<th data-name="Sales_Number" class="<?php echo $view_sales_details_list->Sales_Number->headerCellClass() ?>"><div id="elh_view_sales_details_Sales_Number" class="view_sales_details_Sales_Number"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sales_Number" class="<?php echo $view_sales_details_list->Sales_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Sales_Number) ?>', 1);"><div id="elh_view_sales_details_Sales_Number" class="view_sales_details_Sales_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Sales_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Sales_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Supplier_Number->Visible) { // Supplier_Number ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Supplier_Number) == "") { ?>
		<th data-name="Supplier_Number" class="<?php echo $view_sales_details_list->Supplier_Number->headerCellClass() ?>"><div id="elh_view_sales_details_Supplier_Number" class="view_sales_details_Supplier_Number"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Supplier_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Supplier_Number" class="<?php echo $view_sales_details_list->Supplier_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Supplier_Number) ?>', 1);"><div id="elh_view_sales_details_Supplier_Number" class="view_sales_details_Supplier_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Supplier_Number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Supplier_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Supplier_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Stock_Item->Visible) { // Stock_Item ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Stock_Item) == "") { ?>
		<th data-name="Stock_Item" class="<?php echo $view_sales_details_list->Stock_Item->headerCellClass() ?>"><div id="elh_view_sales_details_Stock_Item" class="view_sales_details_Stock_Item"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Stock_Item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stock_Item" class="<?php echo $view_sales_details_list->Stock_Item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Stock_Item) ?>', 1);"><div id="elh_view_sales_details_Stock_Item" class="view_sales_details_Stock_Item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Stock_Item->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Stock_Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Stock_Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Sales_Quantity->Visible) { // Sales_Quantity ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Sales_Quantity) == "") { ?>
		<th data-name="Sales_Quantity" class="<?php echo $view_sales_details_list->Sales_Quantity->headerCellClass() ?>"><div id="elh_view_sales_details_Sales_Quantity" class="view_sales_details_Sales_Quantity"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sales_Quantity" class="<?php echo $view_sales_details_list->Sales_Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Sales_Quantity) ?>', 1);"><div id="elh_view_sales_details_Sales_Quantity" class="view_sales_details_Sales_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Sales_Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Sales_Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Purchasing_Price->Visible) { // Purchasing_Price ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Purchasing_Price) == "") { ?>
		<th data-name="Purchasing_Price" class="<?php echo $view_sales_details_list->Purchasing_Price->headerCellClass() ?>"><div id="elh_view_sales_details_Purchasing_Price" class="view_sales_details_Purchasing_Price"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Purchasing_Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Purchasing_Price" class="<?php echo $view_sales_details_list->Purchasing_Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Purchasing_Price) ?>', 1);"><div id="elh_view_sales_details_Purchasing_Price" class="view_sales_details_Purchasing_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Purchasing_Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Purchasing_Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Purchasing_Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Sales_Price->Visible) { // Sales_Price ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Sales_Price) == "") { ?>
		<th data-name="Sales_Price" class="<?php echo $view_sales_details_list->Sales_Price->headerCellClass() ?>"><div id="elh_view_sales_details_Sales_Price" class="view_sales_details_Sales_Price"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sales_Price" class="<?php echo $view_sales_details_list->Sales_Price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Sales_Price) ?>', 1);"><div id="elh_view_sales_details_Sales_Price" class="view_sales_details_Sales_Price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Price->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Sales_Price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Sales_Price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_sales_details_list->Sales_Total_Amount->Visible) { // Sales_Total_Amount ?>
	<?php if ($view_sales_details_list->SortUrl($view_sales_details_list->Sales_Total_Amount) == "") { ?>
		<th data-name="Sales_Total_Amount" class="<?php echo $view_sales_details_list->Sales_Total_Amount->headerCellClass() ?>"><div id="elh_view_sales_details_Sales_Total_Amount" class="view_sales_details_Sales_Total_Amount"><div class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Total_Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sales_Total_Amount" class="<?php echo $view_sales_details_list->Sales_Total_Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_sales_details_list->SortUrl($view_sales_details_list->Sales_Total_Amount) ?>', 1);"><div id="elh_view_sales_details_Sales_Total_Amount" class="view_sales_details_Sales_Total_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_sales_details_list->Sales_Total_Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_sales_details_list->Sales_Total_Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_sales_details_list->Sales_Total_Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_sales_details_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_sales_details_list->ExportAll && $view_sales_details_list->isExport()) {
	$view_sales_details_list->StopRecord = $view_sales_details_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view_sales_details_list->TotalRecords > $view_sales_details_list->StartRecord + $view_sales_details_list->DisplayRecords - 1)
		$view_sales_details_list->StopRecord = $view_sales_details_list->StartRecord + $view_sales_details_list->DisplayRecords - 1;
	else
		$view_sales_details_list->StopRecord = $view_sales_details_list->TotalRecords;
}
$view_sales_details_list->RecordCount = $view_sales_details_list->StartRecord - 1;
if ($view_sales_details_list->Recordset && !$view_sales_details_list->Recordset->EOF) {
	$view_sales_details_list->Recordset->moveFirst();
	$selectLimit = $view_sales_details_list->UseSelectLimit;
	if (!$selectLimit && $view_sales_details_list->StartRecord > 1)
		$view_sales_details_list->Recordset->move($view_sales_details_list->StartRecord - 1);
} elseif (!$view_sales_details->AllowAddDeleteRow && $view_sales_details_list->StopRecord == 0) {
	$view_sales_details_list->StopRecord = $view_sales_details->GridAddRowCount;
}

// Initialize aggregate
$view_sales_details->RowType = ROWTYPE_AGGREGATEINIT;
$view_sales_details->resetAttributes();
$view_sales_details_list->renderRow();
while ($view_sales_details_list->RecordCount < $view_sales_details_list->StopRecord) {
	$view_sales_details_list->RecordCount++;
	if ($view_sales_details_list->RecordCount >= $view_sales_details_list->StartRecord) {
		$view_sales_details_list->RowCount++;

		// Set up key count
		$view_sales_details_list->KeyCount = $view_sales_details_list->RowIndex;

		// Init row class and style
		$view_sales_details->resetAttributes();
		$view_sales_details->CssClass = "";
		if ($view_sales_details_list->isGridAdd()) {
		} else {
			$view_sales_details_list->loadRowValues($view_sales_details_list->Recordset); // Load row values
		}
		$view_sales_details->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_sales_details->RowAttrs->merge(["data-rowindex" => $view_sales_details_list->RowCount, "id" => "r" . $view_sales_details_list->RowCount . "_view_sales_details", "data-rowtype" => $view_sales_details->RowType]);

		// Render row
		$view_sales_details_list->renderRow();

		// Render list options
		$view_sales_details_list->renderListOptions();
?>
	<tr <?php echo $view_sales_details->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view_sales_details_list->ListOptions->render("body", "left", $view_sales_details_list->RowCount);
?>
	<?php if ($view_sales_details_list->Sales_ID->Visible) { // Sales_ID ?>
		<td data-name="Sales_ID" <?php echo $view_sales_details_list->Sales_ID->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Sales_ID">
<span<?php echo $view_sales_details_list->Sales_ID->viewAttributes() ?>><?php echo $view_sales_details_list->Sales_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Sales_Number->Visible) { // Sales_Number ?>
		<td data-name="Sales_Number" <?php echo $view_sales_details_list->Sales_Number->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Sales_Number">
<span<?php echo $view_sales_details_list->Sales_Number->viewAttributes() ?>><?php echo $view_sales_details_list->Sales_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Supplier_Number->Visible) { // Supplier_Number ?>
		<td data-name="Supplier_Number" <?php echo $view_sales_details_list->Supplier_Number->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Supplier_Number">
<span<?php echo $view_sales_details_list->Supplier_Number->viewAttributes() ?>><?php echo $view_sales_details_list->Supplier_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Stock_Item->Visible) { // Stock_Item ?>
		<td data-name="Stock_Item" <?php echo $view_sales_details_list->Stock_Item->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Stock_Item">
<span<?php echo $view_sales_details_list->Stock_Item->viewAttributes() ?>><?php echo $view_sales_details_list->Stock_Item->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Sales_Quantity->Visible) { // Sales_Quantity ?>
		<td data-name="Sales_Quantity" <?php echo $view_sales_details_list->Sales_Quantity->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Sales_Quantity">
<span<?php echo $view_sales_details_list->Sales_Quantity->viewAttributes() ?>><?php echo $view_sales_details_list->Sales_Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Purchasing_Price->Visible) { // Purchasing_Price ?>
		<td data-name="Purchasing_Price" <?php echo $view_sales_details_list->Purchasing_Price->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Purchasing_Price">
<span<?php echo $view_sales_details_list->Purchasing_Price->viewAttributes() ?>><?php echo $view_sales_details_list->Purchasing_Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Sales_Price->Visible) { // Sales_Price ?>
		<td data-name="Sales_Price" <?php echo $view_sales_details_list->Sales_Price->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Sales_Price">
<span<?php echo $view_sales_details_list->Sales_Price->viewAttributes() ?>><?php echo $view_sales_details_list->Sales_Price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_sales_details_list->Sales_Total_Amount->Visible) { // Sales_Total_Amount ?>
		<td data-name="Sales_Total_Amount" <?php echo $view_sales_details_list->Sales_Total_Amount->cellAttributes() ?>>
<span id="el<?php echo $view_sales_details_list->RowCount ?>_view_sales_details_Sales_Total_Amount">
<span<?php echo $view_sales_details_list->Sales_Total_Amount->viewAttributes() ?>><?php echo $view_sales_details_list->Sales_Total_Amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_sales_details_list->ListOptions->render("body", "right", $view_sales_details_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view_sales_details_list->isGridAdd())
		$view_sales_details_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view_sales_details->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view_sales_details_list->Recordset)
	$view_sales_details_list->Recordset->Close();
?>
<?php if (!$view_sales_details_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view_sales_details_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_sales_details_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_sales_details_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view_sales_details_list->TotalRecords == 0 && !$view_sales_details->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view_sales_details_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view_sales_details_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view_sales_details_list->isExport()) { ?>
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
$view_sales_details_list->terminate();
?>
<?php
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';

// Costumers class
require_once PARENT . '/associates/lib/Products/Products.php';
$costumers = new Products();

// Get Input data from query string
$order_by	= filter_input(INPUT_GET, 'order_by');
$order_dir	= filter_input(INPUT_GET, 'order_dir');
$search_str	= filter_input(INPUT_GET, 'search_str');
$current_associate = $_SESSION['associate_user_id'] ;
// Per page limit for pagination
$pagelimit = 30;

// Get current pagecostumers
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$order_by) {
	$order_by = 'id';
}
if (!$order_dir) {
	$order_dir = 'Desc';
}

// Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'product_name', 'product_desc','product_owner' ,'product_category','product_discount_price', 'product_cost_price', 'file_name','product_price', 'product_quality','created_at', 'updated_at');

// Start building query according to input parameters
// If search string
if ($search_str) {
	$db->where('product_name', '%' . $search_str . '%', 'like');
	$db->orwhere('product_category', '%' . $search_str . '%', 'like');
}
// If order direction option selected
if ($order_dir) {
	$db->orderBy($order_by, $order_dir);
}

// Set pagination limit
$db->pageLimit = $pagelimit;
$db->where('product_owner', $current_associate );

// Get result of the query
$rows = $db->arraybuilder()->paginate('products', $page, $select);
$total_pages_app = $db->totalPages;

$name = $db->where('id',$current_associate)->getValue('associate_accounts','bussiness_name');

?>

<?php  include PARENT . '/associates/includes/header-nav.php'; ?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Approved Products</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_product.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>

    <!-- Filters -->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_str" value="<?php echo htmlspecialchars($search_str, ENT_QUOTES, 'UTF-8'); ?>">
            <label for="input_order">Order By</label>
            <select name="order_by" class="form-control">
                <?php
            foreach ($costumers->setOrderingValues() as $opt_value => $opt_name):
                ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
                echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
            endforeach;
            ?>
            </select>
            <select name="order_dir" class="form-control" id="input_order">
            <option value="Asc" <?php
            if ($order_dir == 'Asc') {
                echo 'selected';
            }
            ?> >Asc</option>
                            <option value="Desc" <?php
            if ($order_dir == 'Desc') {
                echo 'selected';
            }
            ?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>
    <!-- //Filters -->

    <!-- Table -->

    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th> Category</th>
                <th> Quality</th>
                <th> Cost Price</th>
                <th>Selling Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo substr($row['product_desc'],0,50); ?>...</td>
            <td><?php echo htmlspecialchars($row['product_category']); ?></td>
                <td><?php echo htmlspecialchars($row['product_quality']); ?></td>
                <td><?php echo htmlspecialchars($row['product_cost_price']); ?></td>
                <td><?php echo htmlspecialchars($row['product_discount_price']); ?></td>

                <td>
                    <a class ="btn btn-success" 
                    href="whatsapp://send?text=%2A<?php echo $row['product_name']?>%2A%20%2A,
                          <?php echo $name;?>%2A%0A%2ABrooks%20Fashion%2A Save ₹ <?php echo $row['product_price']-$row['product_discount_price'] ?>/= %0A Get yours for ₹<?php echo $row['product_discount_price'] ?>/= %0A Buy now https://brooksfashion.ml/product-single.php?id=<?php echo $row['id'] ?>" 
                    data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a href="view_product.php?product_id=<?php echo $row['id']; ?>&operation=view" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="view_product.php?product_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="#"  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>

                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_actual_product.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this product?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id ="delete_the_product" data-images="<?php echo $row['file_name']; ?>" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->

           
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    	<?php echo paginationLinks($page, $total_pages_app, 'approved_products.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<script>
$("#delete_the_product").click(function(){
delete_product_images($(this).data('images'));
    });
</script>
<!-- //Main container -->
<?php include PARENT . '/associates/includes/footer.php'; ?>

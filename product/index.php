<?php
require __DIR__ . '/../autoload.php';

use ClientApi\ShopifyClient;

try {
    $shopify = new ShopifyClient();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();  
}
$products = $shopify->getClientData('products');
$customers = $shopify->getClientData('customers');
?>
    <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/style.css">
    <h1>Products List</h1>
    <div class="product-list">
        <?php        
        foreach ($products['products'] as $product):
        ?>
            <div class="product-card">
                <?php if (!empty($product['images'][0]['src'])): ?>
                    <img src="<?= htmlspecialchars($product['images'][0]['src']) ?>" alt="<?= htmlspecialchars($product['images'][0]['alt']) ?>" />
                <?php endif; ?>
                <div class="product-title"><?= htmlspecialchars($product['title']) ?></div>
                <div class="product-description"><?= htmlspecialchars($product['body_html']) ?></div>
                <div class="product-vendor">Vendor: <?= htmlspecialchars($product['vendor']) ?></div>
                <div class="product-price">
                    <?php foreach ($product['variants'] as $variant): ?>
                        <p><?= htmlspecialchars($variant['title']) ?> - $<?= htmlspecialchars($variant['price']) ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h1>Customers List</h1>
    <div class="customer-list">
        <?php
        foreach ($customers['customers'] as $customer):
        ?>
            <div class="customer-card">
                <div class="customer-name">
                    <?= htmlspecialchars($customer['first_name']) ?> <?= htmlspecialchars($customer['last_name']) ?>
                </div>
                <div class="customer-email">
                    <?= htmlspecialchars($customer['email']) ?>
                </div>
                <div class="customer-phone">
                    <?= htmlspecialchars($customer['phone']) ?>
                </div>
                <div class="customer-orders-count">
                    Orders Count: <?= htmlspecialchars($customer['orders_count']) ?>
                </div>
                <div class="customer-total-spent">
                    Total Spent: $<?= number_format($customer['total_spent'], 2) ?>
                </div>
                <div class="customer-status">
                    Status: <?= htmlspecialchars($customer['state']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
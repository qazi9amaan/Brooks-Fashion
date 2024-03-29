<div class="container-fluid">
            <h3 class="orders-title">Orders</h3>
            <div class="list-group">
            <?php foreach ($order_rows as $order): ?>

                <?php 
                    $db2 = getDbInstance();

                    switch($order['notification_type']){

                        case "confirming-payment":
                            $product = $db2->where('id',$order['product_id'])->getOne("products");
                            $name= $db2->where('user',$order['user_id'])->getOne("user_profiles");
                            $msg =  "<strong>" .$name['full_name'].'</strong> brought your product <strong>'.$product['product_name']."  </strong> please wait while admin confirms the payment confirm payment. ";
                            $icon ='fa fa-shopping-cart fa-fw';
                            $class="";
                            $link ='/associates/panel-items/orders/confriming-payment.php';
                            break;
                    
                      case "delivering":
                            $product = $db2->where('id',$order['product_id'])->getOne("products");
                            $name= $db2->where('user',$order['user_id'])->getOne("user_profiles");
                            $msg =  "<strong>" .$name['full_name'].'</strong> brought your product <strong>'.$product['product_name']." </strong> The payment is confirmed, please deliver it!.";
                            $icon ='fa fa-shopping-cart fa-fw';
                            $class="";
                            $link ='/associates/panel-items/orders/delivering_orders.php';
                            break;
                    
                      case "accepted":
                            $product = $db2->where('id',$order['product_id'])->getOne("products");
                            $name= $db2->where('user',$order['user_id'])->getOne("user_profiles");
                            $msg =  "<strong>" .$name['full_name'].'</strong> brought your product <strong>'.$product['product_name']."</strong>  please wait while the customer chooses a payment type. ";
                            $icon ='fa fa-shopping-cart fa-fw';
                            $class="";
                            $link ='/associates/panel-items/orders/accepted_orders.php';
                            break;
                    
                        case "user_approved_order":
                            $product = $db2->where('id',$order['product_id'])->getOne("products");
                            $name= $db2->where('user',$order['user_id'])->getOne("user_profiles");
                            $msg =  "<strong>" .$name['full_name'].'</strong> has successfully approved the payment method for <strong>'.$product['product_name']."</strong>, please proceed ahead.";
                            $icon ='fa fa-thumbs-up fa-fw';
                            $class="";
                            $link ='/associates/panel-items/orders/delivering_orders.php';
                            break;
                       
                    }


                ?>
                  <a href="<?php echo $link ?>" class="<?php echo $class ?> list-group-item list-group-item-action notification_item">
                            <div>
                            <i class="<?php echo $icon ?>"></i>
                        
                        <span><?php echo $msg ?></span>
                            </div>
                              <span class="timestamp">
                                  <?php echo date( 'm/d/y', strtotime($order['created_at'])); ?>
                              </span>
                          
                  </a>
             

            <?php endforeach; ?>

            </div>

            </div>
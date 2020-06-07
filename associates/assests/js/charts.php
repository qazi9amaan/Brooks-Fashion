
<?php 
 require_once '/var/www/html/admin/config/config.php';
 $current_associate = $_SESSION['associate_user_id'] ;
?>
<!-- radialBar Source -->
<?php
 $db = getDbInstance();
 $accepted_orders  = 0;
 $rejected_orders  = 0;
 $new_orders  = 0;
 $delivered_orders  = 0;
 $delivering_orders =0;

 $result =  $db->where('owner',$current_associate)->get('orders ',null,'order_status');
 foreach ($result as $row):
    switch($row['order_status']){
        case "confirming":
          $new_orders +=1;
        break;
        case "accepted":
          $accepted_orders +=1;
        break;
        case "rejected":
            $rejected_orders +=1;
        break;
        case "delivered":
            $delivered_orders+=1;
        break;
        case "delivering":
          $delivering_orders+=1;
      break;
        default:
      }

    endforeach;
 $total_orders=$accepted_orders +$rejected_orders +$new_orders +$delivered_orders+$delivering_orders;
  
?>
<!-- MONTHLY STATICTS -->
<?php
$db2 = getDbInstance();
$data_products_count = $db2->groupBy('MONTH("created_at")')->where('product_owner',$current_associate)->get('products',null,'count(*),MONTH(created_at)');
$data_orders_count = $db2->groupBy('MONTH("ordered_at")')->where('owner',$current_associate)->get('orders',null,'count(*),MONTH(ordered_at)');
$data_orders  = array();
$data_products  = array();
for ($x = 0; $x <= 11; $x++) {
  $data_orders[$x] =0;
  $data_products[$x] =0;

} 
foreach ($data_products_count as $row):
    $data_products[$row['MONTH(created_at)']]=$row['count(*)'];
endforeach;
 
foreach ($data_orders_count as $row):
  $data_orders[$row['MONTH(ordered_at)']]=$row['count(*)'];
endforeach;
?>




<script>
window.onload = function() {

    var options = {
        series: [<?php echo $accepted_orders ;?>,
            <?php echo $rejected_orders;?>,
            <?php echo  $new_orders; ?>,
            <?php echo $delivered_orders; ?>,
            <?php echo $delivering_orders; ?>

        ],
        chart: {
            height: 300,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return <?php echo $total_orders ;?>;
                        }
                    }
                }
            }
        },
        labels: ['Accepted', 'Rejected', 'Recieved','Delivered','Approved'],
    };
    var chart = new ApexCharts(document.querySelector("#order_details"), options);
    chart.render();


    // STATICTICS
    var options = {
          series: [{
            name: "Products",
            data: <?php echo json_encode($data_products) ;?>
        },
        {
            name: "Orders",
            data: <?php echo json_encode($data_orders) ;?>
        }
        ],
          chart: {
          height: 290,
          type: 'area',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
       
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

       
}
</script>


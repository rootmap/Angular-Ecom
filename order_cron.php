<?php
include 'config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$order_sql="INSERT INTO order_list (`order_id`, `event_id`, `event_name`, `order_read`, `order_updated_by`, `order_billing_phone`, `address`, `order_user_id`, `name`, `order_updated_on`, `order_number`, `order_created`, `order_status`, `order_payment_type`, `order_quantity`, `total`, `admin_full_name`,event_created_by) 
		SELECT 
        orders.order_id,
        e.event_id,
        e.event_title,
        orders.order_read,
        orders.order_updated_by,
        CASE order_shipping_phone WHEN '' THEN 
            CASE order_billing_phone 
                WHEN '' THEN 
                            CASE u.user_phone WHEN '' THEN '' ELSE u.user_phone END
                ELSE orders.order_billing_phone
            END
        ELSE order_shipping_phone END AS order_billing_phone,
        case order_billing_address WHEN '' THEN 
        
        	case order_shipping_address WHEN '' THEN 
            
            	CASE u.usr_address WHEN '' THEN 'EMPTY ADDRESS'
                ELSE u.usr_address END
            	
            ELSE order_shipping_address END
        
        ELSE order_billing_address END AS address,
        orders.order_user_id,
        u.name,
        orders.order_updated_on,
        orders.order_number,
        orders.order_created,
        orders.order_status,
        orders.order_payment_type,
        IFNULL(SUM(oi.OI_quantity),0) as order_quantity,
        (((orders.order_total_amount-orders.order_promotion_discount_amount
          )-orders.order_discount_amount)+orders.order_shipment_charge) as total,
        a.admin_full_name,
        e.event_created_by 
        FROM orders 
        LEFT JOIN (SELECT OE_order_id,OE_event_id FROM order_events) as oe ON `oe`.OE_order_id = orders.order_id 
        LEFT JOIN (SELECT user_id,user_phone,concat(user_first_name,' ',user_last_name) as name,IFNULL(user_street_address,user_delivery_address) as usr_address FROM users) as u ON orders.order_user_id = u.user_id 
        LEFT JOIN (SELECT admin_id,admin_full_name FROM admins) as a ON orders.order_updated_by = a.admin_id   
        LEFT JOIN (SELECT event_id,event_title,event_created_by FROM events) as e ON `oe`.OE_event_id = e.event_id 
        LEFT JOIN (SELECT OI_order_id,OI_quantity FROM order_items) as oi ON `oi`.OI_order_id = orders.order_id 
        WHERE orders.order_id NOT IN (SELECT order_id FROM order_list)
        GROUP BY orders.order_id 
        ORDER BY orders.order_read DESC, 
        orders.order_id DESC LIMIT 0,50";
mysqli_query($con, $order_sql);
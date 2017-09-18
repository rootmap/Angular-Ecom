<?php

/*
list of payment method query
 * ________________________________________________
 *  SELECT
epm.id,
epm.event_id,
e.event_title,
pm.name,
epm.`date`,
CASE epm.status WHEN 0 THEN 'Inactive'
ELSE CASE epm.status WHEN 1 THEN 'Active'
ELSE 'Not Mention' END END AS payment_method_status
FROM `eventwise_payment_method` as epm
LEFT JOIN `events` as e ON epm.event_id=e.event_id
LEFT JOIN `payment_method` as pm on epm.`payment_method_id`=pm.id
ORDER BY epm.id DESC
 * *______________________________________________________
 *
 * edit payment method show selected query
 * _______________________________________________________
 *
 *
 * SELECT
pm.id,
'31' as event_id,
pm.name,
(SELECT count(id) FROM eventwise_payment_method WHERE event_id='31' AND payment_method_id=pm.id AND `status`='1') as pmst
from payment_method as pm
 *
 * ___________________________________________________________________
 */




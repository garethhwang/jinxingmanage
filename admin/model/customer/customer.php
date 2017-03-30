<?php
class ModelCustomerCustomer extends Model {
	public function addCustomer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', realname = '" . $this->db->escape($data['realname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', newsletter = '" . (int)$data['newsletter'] . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', status = '" . (int)$data['status'] . "', approved = '" . (int)$data['approved'] . "', safe = '" . (int)$data['safe'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		if (isset($data['address'])) {
			foreach ($data['address'] as $address) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', realname = '" . $this->db->escape($address['realname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '" . $this->db->escape(isset($address['custom_field']) ? json_encode($address['custom_field']) : '') . "'");

				if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				}
			}
		}
		
		return $customer_id;
	}

	public function editCustomer($customer_id, $data) {
		if (!isset($data['custom_field'])) {
			$data['custom_field'] = array();
		}
        $log = new Log('customer.log');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', realname = '" . $this->db->escape($data['realname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) ."', barcode = '" . $this->db->escape($data['barcode']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', newsletter = '" . (int)$data['newsletter'] . "', status = '" . (int)$data['status'] . "', approved = '" . (int)$data['approved'] . "', safe = '" . (int)$data['safe'] . "' WHERE customer_id = '" . (int)$customer_id . "'");

        $query =$this->db->query("SELECT physical_id FROM " . DB_PREFIX . "customer  where customer_id = '" . (int)$customer_id . "'");
        $log->write('customer_id='.$customer_id);

        if(isset($query->row['physical_id'])) {
            $physical_id = $query->row['physical_id'];
            $log->write('physical_id='.$physical_id);

            $this->db->query("UPDATE " . DB_PREFIX . "physical SET realname = '" . $this->db->escape($data['realname']) . "', height = '" . $this->db->escape($data['height']) . "', weight = '" . $this->db->escape($data['weight']) . "', weight = '" . $this->db->escape($data['weight']) . "', bmiindex = '" . $this->db->escape($data['bmiindex']) . "', bmitype = '" . $this->db->escape($data['bmitype']) . "', lastmenstrualdate = '" . $this->db->escape($data['lastmenstrualdate']) . "', edc = '" . $this->db->escape($data['edc']) . "', gravidity = '" . $this->db->escape($data['gravidity']) . "', parity = '" . $this->db->escape($data['parity']) . "', vaginaldelivery = '" . $this->db->escape($data['vaginaldelivery']) . "', aesarean = '" . $this->db->escape($data['aesarean']) . "', spontaneousabortion = '" . $this->db->escape($data['spontaneousabortion']) . "', drug_inducedabortion = '" . $this->db->escape($data['drug_inducedabortion']) . "', fetal = '" . $this->db->escape($data['fetal']) . "', highrisk = '" . $this->db->escape($data['highrisk']) . "', highriskfactor = '" . $this->db->escape($data['highriskfactor']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE physical_id  = '" . (int)$physical_id . "' AND customer_id = '" . (int)$customer_id . "'");
            $log->write("UPDATE " . DB_PREFIX . "physical SET realname = '" . $this->db->escape($data['realname']) . "', height = '" . $this->db->escape($data['height']) . "', weight = '" . $this->db->escape($data['weight']) . "', weight = '" . $this->db->escape($data['weight']) . "', bmiindex = '" . $this->db->escape($data['bmiindex']) . "', bmitype = '" . $this->db->escape($data['bmitype']) . "', lastmenstrualdate = '" . $this->db->escape($data['lastmenstrualdate']) . "', edc = '" . $this->db->escape($data['edc']) . "', gravidity = '" . $this->db->escape($data['gravidity']) . "', parity = '" . $this->db->escape($data['parity']) . "', vaginaldelivery = '" . $this->db->escape($data['vaginaldelivery']) . "', aesarean = '" . $this->db->escape($data['aesarean']) . "', spontaneousabortion = '" . $this->db->escape($data['spontaneousabortion']) . "', drug_inducedabortion = '" . $this->db->escape($data['drug_inducedabortion']) . "', fetal = '" . $this->db->escape($data['fetal']) . "', highrisk = '" . $this->db->escape($data['highrisk']) . "', highriskfactor = '" . $this->db->escape($data['highriskfactor']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE physical_id  = '" . (int)$physical_id . "' AND customer_id = '" . (int)$customer_id . "'");

            $lastmenstrual = $this->db->query("SELECT lastmenstrualdate FROM " . DB_PREFIX . "physical  WHERE customer_id = '" . (int)$customer_id . "'");

            $lastmenstrualdate = $lastmenstrual->row['lastmenstrualdate'];

            $temp = date_create($lastmenstrualdate);
            $fircheck = date_modify($temp,"+12 weeks");$fircheck = date_format($fircheck,'Y-m-d');$firchecks = date_create($fircheck);$firchecks = date_modify($firchecks,"+7 days");$firchecks = date_format($firchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $seccheck = date_modify($temp,"+16 weeks");$seccheck = date_format($seccheck,'Y-m-d');$secchecks = date_create($seccheck);$secchecks = date_modify($secchecks,"+7 days");$secchecks = date_format($secchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $thicheck = date_modify($temp,"+20 weeks");$thicheck = date_format($thicheck,'Y-m-d');$thichecks = date_create($thicheck);$thichecks = date_modify($thichecks,"+7 days");$thichecks = date_format($thichecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $foucheck = date_modify($temp,"+24 weeks");$foucheck = date_format($foucheck,'Y-m-d');$fouchecks = date_create($foucheck);$fouchecks = date_modify($fouchecks,"+7 days");$fouchecks = date_format($fouchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $fifcheck = date_modify($temp,"+28 weeks");$fifcheck = date_format($fifcheck,'Y-m-d');$fifchecks = date_create($fifcheck);$fifchecks = date_modify($fifchecks,"+7 days");$fifchecks = date_format($fifchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $sixcheck = date_modify($temp,"+30 weeks");$sixcheck = date_format($sixcheck,'Y-m-d');$sixchecks = date_create($sixcheck);$sixchecks = date_modify($sixchecks,"+7 days");$sixchecks = date_format($sixchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $sevcheck = date_modify($temp,"+32 weeks");$sevcheck = date_format($sevcheck,'Y-m-d');$sevchecks = date_create($sevcheck);$sevchecks = date_modify($sevchecks,"+7 days");$sevchecks = date_format($sevchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $eigcheck = date_modify($temp,"+36 weeks");$eigcheck = date_format($eigcheck,'Y-m-d');$eigchecks = date_create($eigcheck);$eigchecks = date_modify($eigchecks,"+7 days");$eigchecks = date_format($eigchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $nincheck = date_modify($temp,"+37 weeks");$nincheck = date_format($nincheck,'Y-m-d');$ninchecks = date_create($nincheck);$ninchecks = date_modify($ninchecks,"+7 days");$ninchecks = date_format($ninchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $tencheck = date_modify($temp,"+38 weeks");$tencheck = date_format($tencheck,'Y-m-d');$tenchecks = date_create($tencheck);$tenchecks = date_modify($tenchecks,"+7 days");$tenchecks = date_format($tenchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $tenseccheck = date_modify($temp,"+39 weeks");$tenseccheck = date_format($tenseccheck,'Y-m-d');$tensecchecks = date_create($tenseccheck);$tensecchecks = date_modify($tensecchecks,"+7 days");$tensecchecks = date_format($tensecchecks,'Y-m-d');$temp = date_create($lastmenstrualdate);
            $tenthicheck = date_modify($temp,"+40 weeks");$tenthicheck = date_format($tenthicheck,'Y-m-d');$tenthichecks = date_create($tenthicheck);$tenthichecks = date_modify($tenthichecks,"+7 days");$tenthichecks = date_format($tenthichecks,'Y-m-d');

            $this->db->query("UPDATE " . DB_PREFIX . "checklist SET lastmenstrualdate ='".$lastmenstrualdate."', fircheck =  '".$fircheck."', fircheckurl =  '" . checklist . "&num=1&start=".$fircheck."&end=".$firchecks."' , seccheck =  '".$seccheck."', seccheckurl =  '" . checklist . "&num=2&start=".$seccheck."&end=".$secchecks."' , thicheck =  '".$thicheck."', thicheckurl =  '" . checklist . "&num=3&start=".$thicheck."&end=".$thichecks."' , foucheck =  '".$foucheck."', foucheckurl =  '" . checklist . "&num=4&start=".$foucheck."&end=".$fouchecks."' , fifcheck =  '".$fifcheck."', fifcheckurl =  '" . checklist . "&num=5&start=".$fifcheck."&end=".$fifchecks."' , sixcheck =  '".$sixcheck."', sixcheckurl =  '" . checklist . "&num=6&start=".$sixcheck."&end=".$sixchecks."' , sevcheck =  '".$sevcheck."', sevcheckurl =  '" . checklist . "&num=7&start=".$sevcheck."&end=".$sevchecks."' , eigcheck =  '".$eigcheck."', eigcheckurl =  '" . checklist . "&num=8&start=".$eigcheck."&end=".$eigchecks."' , nincheck =  '".$nincheck."', nincheckurl =  '" . checklist . "&num=9&start=".$nincheck."&end=".$ninchecks."' , tencheck =  '".$tencheck."', tencheckurl =  '" . checklist . "&num=10&firstart=".$tencheck."&firend=".$tenchecks."&secstart=".$tenseccheck."&secend=".$tensecchecks."&thistart=".$tenthicheck."&thiend=".$tenthichecks."'WHERE  customer_id = '" . (int)$customer_id . "'");
        }

		if ($data['password']) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		if (isset($data['address'])) {
			foreach ($data['address'] as $address) {
				if (!isset($address['custom_field'])) {
					$address['custom_field'] = array();
				}

				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET address_id = '" . (int)$address['address_id'] . "', customer_id = '" . (int)$customer_id . "', realname = '" . $this->db->escape($address['realname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '" . $this->db->escape(isset($address['custom_field']) ? json_encode($address['custom_field']) : '') . "'");

				if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				}
			}
		}
	}

	public function editToken($customer_id, $token) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function deleteCustomer($customer_id) {
	    $query = $this->db->query("SELECT wechat_id FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'" );
	    $wechat_id = $query->row['wechat_id'];

        $query = $this->db->query("SELECT order_id FROM " . DB_PREFIX . "order WHERE customer_id = '" . (int)$customer_id . "'" );
        if(isset($query->row['order_id']))
        {
            $order_id = $query->row['order_id'];
        }

        $query = $this->db->query("SELECT receipt_id FROM " . DB_PREFIX . "receipt_history WHERE customer_id = '" . (int)$customer_id . "'" );
        if(isset($query->row['receipt_id']))
        {
            $receipt_id = $query->row['receipt_id'];
        }

        if(isset($wechat_id)){
            $this->db->query("DELETE FROM " . DB_PREFIX . "nonpregnant WHERE wechat_id = '" . (int)$wechat_id . "'");
            $this->db->query("DELETE FROM wechat_user WHERE wechat_id = '" . (int)$wechat_id . "'");
        }

        if(isset($order_id)){
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_custom_field WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_history WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_recurring WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "voucher WHERE order_id = '" . (int)$order_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "voucher_history WHERE order_id = '" . (int)$order_id . "'");
        }

        if(isset($receipt_id))
        {
            $this->db->query("DELETE FROM " . DB_PREFIX . "receipt WHERE receipt_id = '" . (int)$receipt_id . "'");
        }

		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_activity WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "advise WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "blog_comment WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "coupon_history WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_online WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_search WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "order WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "physical WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "receipt_history WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "return WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE customer_id = '" . (int)$customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "checklist WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function getCustomer($customer_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer, " . DB_PREFIX . "physical WHERE " . DB_PREFIX . "customer.customer_id = '" . (int)$customer_id . "' AND " . DB_PREFIX . "physical.customer_id= '" .(int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomers($data = array()) {
		//$sql = "SELECT *, CONCAT(c.realname) AS name, cgd.name AS customer_group, ca.address_1 AS customer_address FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "address ca ON (c.customer_id = ca.customer_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        $sql = "SELECT *, CONCAT(c.realname) AS name, cgd.name AS customer_group, ca.address_1 AS customer_address FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "address ca ON (c.customer_id = ca.customer_id) LEFT JOIN " . DB_PREFIX . "physical cp ON (c.customer_id = cp.customer_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        $implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

        if (!empty($data['filter_telephone'])) {
            $implode[] = "c.telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
        }

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_lastmenstrualdate'])) {
            $implode[] = "DATE(cp.lastmenstrualdate) = DATE('" . $this->db->escape($data['filter_lastmenstrualdate']) . "')";
        }

        if (!empty($data['filter_receiptdate'])) {
            $implode[] = "DATE(c.receiptdate) = DATE('" . $this->db->escape($data['filter_receiptdate']) . "')";
        }

        if (!empty($data['office_id'])) {
            $implode[] = "c.department =  '" . $data['office_id'] . "'";
        }

        //add for doctor group filter
        if (!empty($data['department'])) {
            $implode[] = "c.department =  '" . $data['department'] . "'";
        }

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'c.ip',
			'c.date_added',
            'c.receiptdate',
            'cp.filter_lastmenstrualdate'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$log = new Log('api.log');
		$log->write($sql);

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function approve($customer_id) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET approved = '1' WHERE customer_id = '" . (int)$customer_id . "'");

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
				$store_url = $store_info['url'] . 'index.php?route=account/login';
			} else {
				$store_name = $this->config->get('config_name');
				$store_url = HTTP_CATALOG . 'index.php?route=account/login';
			}

			$this->load->model('localisation/language');
			
			$language_info = $this->model_localisation_language->getLanguage($customer_info['language_id']);

			if ($language_info) {
				$language_code = $language_info['code'];
			} else {
				$language_code = $this->config->get('config_language');
			}

			$language = new Language($language_code);
			$language->load($language_code);
			$language->load('mail/customer');
				
			$message  = sprintf($language->get('text_approve_welcome'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')) . "\n\n";
			$message .= $language->get('text_approve_login') . "\n";
			$message .= $store_url . "\n\n";
			$message .= $language->get('text_approve_services') . "\n\n";
			$message .= $language->get('text_approve_thanks') . "\n";
			$message .= html_entity_decode($store_name, ENT_QUOTES, 'UTF-8');

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($language->get('text_approve_subject'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "'");

		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			return array(
				'address_id'     => $address_query->row['address_id'],
				'customer_id'    => $address_query->row['customer_id'],
				'realname'      => $address_query->row['realname'],
				'company'        => $address_query->row['company'],
				'address_1'      => $address_query->row['address_1'],
				'address_2'      => $address_query->row['address_2'],
				'postcode'       => $address_query->row['postcode'],
				'city'           => $address_query->row['city'],
				'zone_id'        => $address_query->row['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($address_query->row['custom_field'], true)
			);
		}
	}

	public function getAddresses($customer_id) {
		$address_data = array();

		$query = $this->db->query("SELECT address_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		foreach ($query->rows as $result) {
			$address_info = $this->getAddress($result['address_id']);

			if ($address_info) {
				$address_data[$result['address_id']] = $address_info;
			}
		}

		return $address_data;
	}

	public function getTotalCustomers($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

        if (!empty($data['filter_telephone'])) {
            $implode[] = "telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
        }

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

        if (!empty($data['filter_receiptdate'])) {
            $implode[] = "DATE(receiptdate) = DATE('" . $this->db->escape($data['filter_receiptdate']) . "')";
        }

        if (!empty($data['office_id'])) {
            $implode[] = "department =  '" . $data['office_id'] . "'";
        }

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
        $log = new Log('api.log');
        $log->write($sql);
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalCustomersAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE status = '0' OR approved = '0'");

		return $query->row['total'];
	}

	public function getTotalAddressesByCustomerId($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalAddressesByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}

	public function getTotalAddressesByZoneId($zone_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomersByCustomerGroupId($customer_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int)$customer_group_id . "'");

		return $query->row['total'];
	}

	public function addHistory($customer_id, $comment) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_history SET customer_id = '" . (int)$customer_id . "', comment = '" . $this->db->escape(strip_tags($comment)) . "', date_added = NOW()");
	}

	public function getHistories($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT comment, date_added FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalHistories($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function addTransaction($customer_id, $description = '', $amount = '', $order_id = 0) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($description) . "', amount = '" . (float)$amount . "', date_added = NOW()");

			$this->load->language('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}

			$message  = sprintf($this->language->get('text_transaction_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
			$message .= sprintf($this->language->get('text_transaction_total'), $this->currency->format($this->getTransactionTotal($customer_id), $this->session->data['currency']));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($this->language->get('text_transaction_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function deleteTransaction($order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");
	}

	public function getTransactions($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalTransactions($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTransactionTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalTransactionsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function addReward($customer_id, $description = '', $points = '', $order_id = 0) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', points = '" . (int)$points . "', description = '" . $this->db->escape($description) . "', date_added = NOW()");

			$this->load->language('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}

			$message  = sprintf($this->language->get('text_reward_received'), $points) . "\n\n";
			$message .= sprintf($this->language->get('text_reward_total'), $this->getRewardTotal($customer_id));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($this->language->get('text_reward_subject'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function deleteReward($order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "' AND points > 0");
	}

	public function getRewards($customer_id, $start = 0, $limit = 10) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalRewards($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getRewardTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomerRewardsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "' AND points > 0");

		return $query->row['total'];
	}

	public function getIps($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}
		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}

	public function getTotalIps($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomersByIp($ip) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($ip) . "'");

		return $query->row['total'];
	}

	public function getTotalLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE `email` = '" . $this->db->escape($email) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE `email` = '" . $this->db->escape($email) . "'");
	}

    public function getReceiptByCustomerId($customer_id) {
        $receipt_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "receipt_history WHERE customer_id = '" . (int)$customer_id . "' AND receipt_text != NULL");
        return $receipt_query->rows;
    }

    public function getUserInfo($user_id){
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE user_id = '" . $user_id ."'");
        return $query->row;
    }

}

<?php
class ControllerCustomerCustomer extends Controller {
	private $error = array();

	public function index() {
		try{
			$this->load->language('customer/customer');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->load->model('customer/customer');

			$this->getList();
		}
		catch(Exception $e){
			$this->response->setOutput($e->getMessage());
		}
	}

	public function add() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_customer->addCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_id) {
				$this->model_customer_customer->deleteCustomer($customer_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function approve() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		$customers = array();

		if (isset($this->request->post['selected'])) {
			$customers = $this->request->post['selected'];
		} elseif (isset($this->request->get['customer_id'])) {
			$customers[] = $this->request->get['customer_id'];
		}

		if ($customers && $this->validateApprove()) {
			$this->model_customer_customer->approve($this->request->get['customer_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function unlock() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (isset($this->request->get['email']) && $this->validateUnlock()) {
			$this->model_customer_customer->deleteLoginAttempts($this->request->get['email']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
        if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = null;
		}

        if (isset($this->request->get['filter_telephone'])) {
            $filter_telephone = $this->request->get['filter_telephone'];
        } else {
            $filter_telephone = null;
        }

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['filter_receiptdate'])) {
            $filter_receiptdate = $this->request->get['filter_receiptdate'];
        } else {
            $filter_receiptdate = null;
        }

        if (isset($this->request->get['office_id'])) {
            $office_id = urldecode($this->request->get['office_id']);
        } else {
            $office_id = null;
        }

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_telephone'])) {
            $url .= '&filter_telephone=' . urlencode(html_entity_decode($this->request->get['filter_telephone'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_receiptdate'])) {
            $url .= '&filter_receiptdate=' . $this->request->get['filter_receiptdate'];
        }

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('customer/customer/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['customers'] = array();

		$user_id = $this->user->isLogged();
        $user_info = $this->model_customer_customer->getUserInfo($user_id);

        $user_group_id = $user_info['user_group_id'];
        $user_office_id = $user_info['office_id'];
        $data['user_group_id'] = $user_group_id;

        if($user_group_id != '1'){
            $filter_data = array(
                'filter_name' => $filter_name,
                'filter_email' => $filter_email,
                'filter_telephone' => $filter_telephone,
                'filter_date_added' => $filter_date_added,
                'filter_receiptdate' => $filter_receiptdate,
                'filter_ip' => $filter_ip,
                'office_id' => $office_id,
                'sort' => $sort,
                'order' => $order,
                'department' => $user_office_id,
                'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit' => $this->config->get('config_limit_admin')
            );
        }else {
            $filter_data = array(
                'filter_name' => $filter_name,
                'filter_email' => $filter_email,
                'filter_telephone' => $filter_telephone,
                'filter_date_added' => $filter_date_added,
                'filter_receiptdate' => $filter_receiptdate,
                'filter_ip' => $filter_ip,
                'office_id' => $office_id,
                'sort' => $sort,
                'order' => $order,
                'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit' => $this->config->get('config_limit_admin')
            );
        }

		$customer_total = $this->model_customer_customer->getTotalCustomers($filter_data);

		$results = $this->model_customer_customer->getCustomers($filter_data);

        $currentDate=date("Y-m-d");

        foreach ($results as $result) {
			if (!$result['approved']) {
				$approve = $this->url->link('customer/customer/approve', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true);
			} else {
				$approve = '';
			}

			$login_info = $this->model_customer_customer->getTotalLoginAttempts($result['email']);

			if ($login_info && $login_info['total'] >= $this->config->get('config_login_attempts')) {
				$unlock = $this->url->link('customer/customer/unlock', 'token=' . $this->session->data['token'] . '&email=' . $result['email'] . $url, true);
			} else {
				$unlock = '';
			}

            $ispregnant = $result['ispregnant'];

            if( $ispregnant == 1 ) {
                $firreceipt = date($this->language->get('date_format_short'), strtotime($result['firreceipt']));
                $secreceipt = date($this->language->get('date_format_short'), strtotime($result['secreceipt']));
                $thireceipt = date($this->language->get('date_format_short'), strtotime($result['thireceipt']));

                $receiptrecords = array();
                $receiptrecords = $this->model_customer_customer->getReceiptByCustomerId($result['customer_id']);

                if( sizeof($receiptrecords) > 0 ){
                    foreach ($receiptrecords as $receiptrecord){
                        $date_add = $receiptrecord['date_add'];
                        if(strtotime($date_add) >= strtotime($thireceipt)){
                            $third = $receiptrecord;
                        } elseif (strtotime($date_add) >= strtotime($secreceipt)){
                            $second = $receiptrecord;
                        } elseif (strtotime($date_add) >= strtotime($firreceipt)) {
                            $first = $receiptrecord;
                        }
                    }
                }

                $firstflag=$secondflag=$thirdflag=0;

                if(isset($first)){
                    $firstflag = 1;
                }
                if(isset($second)){
                    $secondflag = 1;
                }
                if(isset($third)){
                    $thirdflag = 1;
                }

                if ( strtotime($currentDate) < strtotime($firreceipt)) {
                    $firurgent=$securgent=$thiurgent=1;
                } else if (strtotime($currentDate) < strtotime("+1 week", strtotime($firreceipt))){
                    $firurgent=2;
                    $securgent=$thiurgent=1;
                } else if ( strtotime($currentDate) < strtotime($secreceipt)) {
                    $firurgent=3;
                    $securgent=$thiurgent=1;
                } else if (strtotime($currentDate) < strtotime("+1 week", strtotime($secreceipt))) {
                    $firurgent=3;
                    $securgent=2;
                    $thiurgent=1;
                } else if ( strtotime($currentDate) < strtotime($thireceipt)) {
                    $firurgent=3;
                    $securgent=3;
                    $thiurgent=1;
                } else if (strtotime($currentDate) < strtotime("+1 week", strtotime($thireceipt))) {
                    $firurgent=3;
                    $securgent=3;
                    $thiurgent=2;
                } else{
                    $thiurgent=3;
                }

                if($firstflag == 1){
                    $firreceipt_title = '已填写提交';
                }else if ($firurgent == 1){
                    $firreceipt_title = '未到填写期';
                }else if ($firurgent == 2){
                    $firreceipt_title = '进入填写期';
                }else if ($firurgent == 3){
                    $firreceipt_title = '过期未填写';
                }

                if($secondflag == 1){
                    $secreceipt_title = '已填写提交';
                }else if ($securgent == 1){
                    $secreceipt_title = '未到填写期';
                }else if ($securgent == 2){
                    $secreceipt_title = '进入填写期';
                }else if ($securgent == 3){
                    $secreceipt_title = '过期未填写';
                }

                if($thirdflag == 1){
                    $thireceipt_title = '已填写提交';
                }else if ($thiurgent == 1){
                    $thireceipt_title = '未到填写期';
                }else if ($thiurgent == 2){
                    $thireceipt_title = '进入填写期';
                }else if ($thiurgent == 3){
                    $thireceipt_title = '过期未填写';
                }
            } else {
                $firreceipt='无';
                $firreceipt_title='';
                $secreceipt='无';
                $secreceipt_title='';
                $thireceipt='无';
                $thireceipt_title='';
                $firurgent=0;
                $securgent=0;
                $thiurgent=0;
            }

            $data['customers'][] = array(
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
                'telephone'     =>  $result['telephone'],
				'customer_group' => $result['customer_group'],
				'ip'             => $result['ip'],
                'firreceipt'    => $firreceipt,
                'firreceipt_title' => $firreceipt_title,
                'firurgent'    => $firurgent,
                'secreceipt'    => $secreceipt,
                'secreceipt_title' => $secreceipt_title,
                'securgent'     => $securgent,
                'thireceipt'    => $thireceipt,
                'thireceipt_title' => $thireceipt_title,
                'thiurgent'     =>  $thiurgent,
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'customer_address'=> $result['customer_address'],
                //'product_duration_visit'=> $result['product_duration_visit'],
				'approve'        => $approve,
				'unlock'         => $unlock,
                'visit_info'     => $this->url->link('customer/customer/visit_info', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true),
				'edit'           => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true)
			);

		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_email'] = $this->language->get('column_email');
        $data['column_telephone'] = $this->language->get('column_telephone');
        $data['column_address'] = $this->language->get('column_address');
        $data['column_customer_group'] = $this->language->get('column_customer_group');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_approved'] = $this->language->get('column_approved');
		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_receiptdate'] = $this->language->get('column_receiptdate');
        $data['column_firreceipt'] = $this->language->get('column_firreceipt');
        $data['column_secreceipt'] = $this->language->get('column_secreceipt');
        $data['column_thireceipt'] = $this->language->get('column_thireceipt');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_office'] = $this->language->get('column_office');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
        $data['entry_telephone'] = $this->language->get('entry_telephone');
        $data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approved'] = $this->language->get('entry_approved');
		$data['entry_ip'] = $this->language->get('entry_ip');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_receiptdate'] = $this->language->get('entry_receiptdate');
        $data['office_name'] = $this->language->get('office_name');

		$data['button_approve'] = $this->language->get('button_approve');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_visit_info'] = '回访信息查询';
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_login'] = $this->language->get('button_login');
		$data['button_unlock'] = $this->language->get('button_unlock');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

        if (isset($this->request->get['filter_telephone'])) {
            $url .= '&filter_telephone=' . urlencode(html_entity_decode($this->request->get['filter_telephone'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

        if (isset($this->request->get['office_id'])) {
            $url .= '&office_id=' . $this->request->get['office_id'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_receiptdate'])) {
            $url .= '&filter_receiptdate=' . $this->request->get['filter_receiptdate'];
        }

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		$data['sort_name'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_email'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, true);
		$data['sort_customer_group'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, true);
		$data['sort_status'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, true);
		$data['sort_ip'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.ip' . $url, true);
		$data['sort_date_added'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, true);
        $data['sort_receiptdate'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.receiptdate' . $url, true);

		$pagination = new Pagination();
		$pagination->total = $customer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_email'] = $filter_email;
        $data['filter_telephone'] = $filter_telephone;
		$data['filter_ip'] = $filter_ip;
        $data['filter_date_added'] = $filter_date_added;
        $data['filter_receiptdate'] = $filter_receiptdate;

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		$data['sort'] = $sort;
		$data['order'] = $order;

		if( $this->user->getGroupId() == 11 ) {
		    $data['header'] = $this->load->view('common/onlyheader');
			$data['column_left'] = "";
		} else {
			$data['header'] = $this->load->controller('common/header');
		    $data['column_left'] = $this->load->controller('common/column_left');
		    $data['footer'] = $this->load->controller('common/footer');
		}

		$this->response->setOutput($this->load->view('customer/customer_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
		$data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_realname'] = $this->language->get('entry_realname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approved'] = $this->language->get('entry_approved');
		$data['entry_safe'] = $this->language->get('entry_safe');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_default'] = $this->language->get('entry_default');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_amount'] = $this->language->get('entry_amount');
		$data['entry_points'] = $this->language->get('entry_points');
        $data['entry_barcode']=$this->language->get('entry_barcode');
        $data['entry_height']=$this->language->get('entry_height');
        $data['entry_weight']=$this->language->get('entry_weight');
        $data['entry_bmitype']=$this->language->get('entry_bmitype');
        $data['entry_bmiindex']=$this->language->get('entry_bmiindex');
        $data['entry_lastmenstrualdate']=$this->language->get('entry_lastmenstrualdate');
        $data['entry_edc']=$this->language->get('entry_edc');
        $data['entry_gravidity']=$this->language->get('entry_gravidity');
        $data['entry_parity']=$this->language->get('entry_parity');
        $data['entry_vaginaldelivery']=$this->language->get('entry_vaginaldelivery');
        $data['entry_aesarean']=$this->language->get('entry_aesarean');
        $data['entry_spontaneousabortion']=$this->language->get('entry_spontaneousabortion');
        $data['entry_drug_inducedabortion']=$this->language->get('entry_drug_inducedabortion');
        $data['entry_highrisk']=$this->language->get('entry_highrisk');
        $data['entry_highriskfactor']=$this->language->get('entry_highriskfactor');

		$data['help_safe'] = $this->language->get('help_safe');
		$data['help_points'] = $this->language->get('help_points');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_address_add'] = $this->language->get('button_address_add');
		$data['button_history_add'] = $this->language->get('button_history_add');
		$data['button_transaction_add'] = $this->language->get('button_transaction_add');
		$data['button_reward_add'] = $this->language->get('button_reward_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_upload'] = $this->language->get('button_upload');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_address'] = $this->language->get('tab_address');
		$data['tab_history'] = $this->language->get('tab_history');
		$data['tab_transaction'] = $this->language->get('tab_transaction');
		$data['tab_reward'] = $this->language->get('tab_reward');
        $data['tab_ip'] = $this->language->get('tab_ip');
        $data['tab_basic_info'] = $this->language->get('tab_basic_info');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['customer_id'])) {
			$data['customer_id'] = $this->request->get['customer_id'];
		} else {
			$data['customer_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['realname'])) {
			$data['error_realname'] = $this->error['realname'];
		} else {
			$data['error_realname'] = '';
		}


		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}
		
		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}
		
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['customer_id'])) {
			$data['action'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, true);
		}

        $user_id = $this->user->isLogged();
        $user_info = $this->model_customer_customer->getUserInfo($user_id);

        $user_group_id = $user_info['user_group_id'];
        $data['user_group_id'] = $user_group_id;

		$data['cancel'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($customer_info)) {
			$data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['realname'])) {
			$data['realname'] = $this->request->post['realname'];
		} elseif (!empty($customer_info)) {
			$data['realname'] = $customer_info['realname'];
		} else {
			$data['realname'] = '';
		}

        if (isset($this->request->post['height'])) {
            $data['height'] = $this->request->post['height'];
        } elseif (!empty($customer_info)) {
            $data['height'] = $customer_info['height'];
        } else {
            $data['height'] = '';
        }

        if (isset($this->request->post['weight'])) {
            $data['weight'] = $this->request->post['weight'];
        } elseif (!empty($customer_info)) {
            $data['weight'] = $customer_info['weight'];
        } else {
            $data['weight'] = '';
        }

        if (isset($this->request->post['bmitype'])) {
            $data['bmitype'] = $this->request->post['bmitype'];
        } elseif (!empty($customer_info)) {
            $data['bmitype'] = $customer_info['bmitype'];
        } else {
            $data['bmitype'] = '';
        }

        if (isset($this->request->post['bmiindex'])) {
            $data['bmiindex'] = $this->request->post['bmiindex'];
        } elseif (!empty($customer_info)) {
            $data['bmiindex'] = $customer_info['bmiindex'];
        } else {
            $data['bmiindex'] = '';
        }

        if (isset($this->request->post['lastmenstrualdate'])) {
            $data['lastmenstrualdate'] = $this->request->post['lastmenstrualdate'];
        } elseif (!empty($customer_info)) {
            $data['lastmenstrualdate'] = $customer_info['lastmenstrualdate'];
        } else {
            $data['lastmenstrualdate'] = '';
        }

        if (isset($this->request->post['gravidity'])) {
            $data['gravidity'] = $this->request->post['gravidity'];
        } elseif (!empty($customer_info)) {
            $data['gravidity'] = $customer_info['gravidity'];
        } else {
            $data['gravidity'] = '';
        }

        if (isset($this->request->post['parity'])) {
            $data['parity'] = $this->request->post['parity'];
        } elseif (!empty($customer_info)) {
            $data['parity'] = $customer_info['parity'];
        } else {
            $data['parity'] = '';
        }

        if (isset($this->request->post['vaginaldelivery'])) {
            $data['vaginaldelivery'] = $this->request->post['vaginaldelivery'];
        } elseif (!empty($customer_info)) {
            $data['vaginaldelivery'] = $customer_info['vaginaldelivery'];
        } else {
            $data['vaginaldelivery'] = '';
        }

        if (isset($this->request->post['aesarean'])) {
            $data['aesarean'] = $this->request->post['aesarean'];
        } elseif (!empty($customer_info)) {
            $data['aesarean'] = $customer_info['aesarean'];
        } else {
            $data['aesarean'] = '';
        }

        if (isset($this->request->post['spontaneousabortion'])) {
            $data['spontaneousabortion'] = $this->request->post['spontaneousabortion'];
        } elseif (!empty($customer_info)) {
            $data['spontaneousabortion'] = $customer_info['spontaneousabortion'];
        } else {
            $data['spontaneousabortion'] = '';
        }

        if (isset($this->request->post['drug_inducedabortion'])) {
            $data['drug_inducedabortion'] = $this->request->post['drug_inducedabortion'];
        } elseif (!empty($customer_info)) {
            $data['drug_inducedabortion'] = $customer_info['drug_inducedabortion'];
        } else {
            $data['drug_inducedabortion'] = '';
        }

        if (isset($this->request->post['highrisk'])) {
            $data['highrisk'] = $this->request->post['highrisk'];
        } elseif (!empty($customer_info)) {
            $data['highrisk'] = $customer_info['highrisk'];
        } else {
            $data['highrisk'] = '';
        }

        if (isset($this->request->post['highriskfactor'])) {
            $data['highriskfactor'] = $this->request->post['highriskfactor'];
        } elseif (!empty($customer_info)) {
            $data['highriskfactor'] = $customer_info['highriskfactor'];
        } else {
            $data['highriskfactor'] = '';
        }

        if (isset($this->request->post['edc'])) {
            $data['edc'] = $this->request->post['edc'];
        } elseif (!empty($customer_info)) {
            $data['edc'] = $customer_info['edc'];
        } else {
            $data['edc'] = '';
        }

        if (isset($this->request->post['barcode'])) {
            $data['barcode'] = $this->request->post['barcode'];
        } elseif (!empty($customer_info)) {
            $data['barcode'] = $customer_info['barcode'];
        } else {
            $data['barcode'] = '';
        }

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$data['telephone'] = $customer_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} elseif (!empty($customer_info)) {
			$data['fax'] = $customer_info['fax'];
		} else {
			$data['fax'] = '';
		}

		// Custom Fields
		$this->load->model('customer/custom_field');

		$data['custom_fields'] = array();

		$filter_data = array(
			'sort'  => 'cf.sort_order',
			'order' => 'ASC'
		);

		$custom_fields = $this->model_customer_custom_field->getCustomFields($filter_data);

		foreach ($custom_fields as $custom_field) {
			$data['custom_fields'][] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $this->model_customer_custom_field->getCustomFieldValues($custom_field['custom_field_id']),
				'name'               => $custom_field['name'],
				'value'              => $custom_field['value'],
				'type'               => $custom_field['type'],
				'location'           => $custom_field['location'],
				'sort_order'         => $custom_field['sort_order']
			);
		}

		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (!empty($customer_info)) {
			$data['account_custom_field'] = json_decode($customer_info['custom_field'], true);
		} else {
			$data['account_custom_field'] = array();
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} elseif (!empty($customer_info)) {
			$data['newsletter'] = $customer_info['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($customer_info)) {
			$data['status'] = $customer_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['approved'])) {
			$data['approved'] = $this->request->post['approved'];
		} elseif (!empty($customer_info)) {
			$data['approved'] = $customer_info['approved'];
		} else {
			$data['approved'] = true;
		}

		if (isset($this->request->post['safe'])) {
			$data['safe'] = $this->request->post['safe'];
		} elseif (!empty($customer_info)) {
			$data['safe'] = $customer_info['safe'];
		} else {
			$data['safe'] = 0;
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		if (isset($this->request->post['address'])) {
			$data['addresses'] = $this->request->post['address'];
		} elseif (isset($this->request->get['customer_id'])) {
			$data['addresses'] = $this->model_customer_customer->getAddresses($this->request->get['customer_id']);
		} else {
			$data['addresses'] = array();
		}

		if (isset($this->request->post['address_id'])) {
			$data['address_id'] = $this->request->post['address_id'];
		} elseif (!empty($customer_info)) {
			$data['address_id'] = $customer_info['address_id'];
		} else {
			$data['address_id'] = '';
		}

		if( $this->user->getGroupId() == 11 ) {
		    $data['header'] = $this->load->view('common/onlyheader');
			$data['column_left'] = "";
		} else {
			$data['header'] = $this->load->controller('common/header');
		    $data['column_left'] = $this->load->controller('common/column_left');
		    $data['footer'] = $this->load->controller('common/footer');
		}

		$this->response->setOutput($this->load->view('customer/customer_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['realname']) < 1) || (utf8_strlen(trim($this->request->post['realname'])) > 32)) {
			$this->error['realname'] = $this->language->get('error_realname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		/*
		$customer_info = $this->model_customer_customer->getCustomerByEmail($this->request->post['email']);

		if (!isset($this->request->get['customer_id'])) {
			if ($customer_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}
*/
		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		// Custom field validation
		$this->load->model('customer/custom_field');

		$custom_fields = $this->model_customer_custom_field->getCustomFields(array('filter_customer_group_id' => $this->request->post['customer_group_id']));

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'account') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['location'] == 'account') && ($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($this->request->post['custom_field'][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}

		if (isset($this->request->post['address'])) {
			foreach ($this->request->post['address'] as $key => $value) {
				if ((utf8_strlen($value['realname']) < 1) || (utf8_strlen($value['realname']) > 32)) {
					$this->error['address'][$key]['realname'] = $this->language->get('error_realname');
				}


				if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
					$this->error['address'][$key]['address_1'] = $this->language->get('error_address_1');
				}
/*
				if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
					$this->error['address'][$key]['city'] = $this->language->get('error_city');
				}
*/
				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($value['country_id']);

				if ($country_info && $country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2 || utf8_strlen($value['postcode']) > 10)) {
					$this->error['address'][$key]['postcode'] = $this->language->get('error_postcode');
				}
/*
				if ($value['country_id'] == '') {
					$this->error['address'][$key]['country'] = $this->language->get('error_country');
				}

				if (!isset($value['zone_id']) || $value['zone_id'] == '') {
					$this->error['address'][$key]['zone'] = $this->language->get('error_zone');
				}
*/
				foreach ($custom_fields as $custom_field) {
					if (($custom_field['location'] == 'address') && $custom_field['required'] && empty($value['custom_field'][$custom_field['custom_field_id']])) {
						$this->error['address'][$key]['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
					} elseif (($custom_field['location'] == 'address') && ($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($value['custom_field'][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
						$this->error['address'][$key]['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
                    }
				}
			}
		}

		var_dump($this->error);

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateApprove() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateUnlock() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function login() {
		if (isset($this->request->get['customer_id'])) {
			$customer_id = $this->request->get['customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->load->model('customer/customer');

		$customer_info = $this->model_customer_customer->getCustomer($customer_id);

		if ($customer_info) {
			// Create token to login with
			$token = token(64);

			$this->model_customer_customer->editToken($customer_id, $token);

			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$this->response->redirect($store_info['url'] . 'index.php?route=account/login&token=' . $token);
			} else {
				$this->response->redirect(HTTP_CATALOG . 'index.php?route=account/login&token=' . $token);
			}
		} else {
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], true)
			);

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function history() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_date_added'] = $this->language->get('column_date_added');
       // $data['column_product_duration_visit'] = $this->language->get('column_product_duration_visit');
		$data['column_comment'] = $this->language->get('column_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['histories'] = array();

		$results = $this->model_customer_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['histories'][] = array(
				'comment'    => $result['comment'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_customer_customer->getTotalHistories($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_history', $data));
	}

	public function addHistory() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function transaction() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_balance'] = $this->language->get('text_balance');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_amount'] = $this->language->get('column_amount');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['transactions'] = array();

		$results = $this->model_customer_customer->getTransactions($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$data['balance'] = $this->currency->format($this->model_customer_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));

		$transaction_total = $this->model_customer_customer->getTotalTransactions($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($transaction_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($transaction_total - 10)) ? $transaction_total : ((($page - 1) * 10) + 10), $transaction_total, ceil($transaction_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_transaction', $data));
	}

	public function addTransaction() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addTransaction($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function reward() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_balance'] = $this->language->get('text_balance');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_points'] = $this->language->get('column_points');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['rewards'] = array();

		$results = $this->model_customer_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['rewards'][] = array(
				'points'      => $result['points'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$data['balance'] = $this->model_customer_customer->getRewardTotal($this->request->get['customer_id']);

		$reward_total = $this->model_customer_customer->getTotalRewards($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $reward_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($reward_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($reward_total - 10)) ? $reward_total : ((($page - 1) * 10) + 10), $reward_total, ceil($reward_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_reward', $data));
	}

	public function addReward() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function ip() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_date_added'] = $this->language->get('column_date_added');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['ips'] = array();

		$results = $this->model_customer_customer->getIps($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['ips'][] = array(
				'ip'         => $result['ip'],
				'total'      => $this->model_customer_customer->getTotalCustomersByIp($result['ip']),
				'date_added' => date('d/m/y', strtotime($result['date_added'])),
				'filter_ip'  => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], true)
			);
		}

		$ip_total = $this->model_customer_customer->getTotalIps($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $ip_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/ip', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($ip_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($ip_total - 10)) ? $ip_total : ((($page - 1) * 10) + 10), $ip_total, ceil($ip_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_ip', $data));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])) {
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = '';
			}

			$this->load->model('customer/customer');

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->model_customer_customer->getCustomers($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'customer_id'       => $result['customer_id'],
					'customer_group_id' => $result['customer_group_id'],
					'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'customer_group'    => $result['customer_group'],
					'realname'         => $result['realname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
					'fax'               => $result['fax'],
					'custom_field'      => json_decode($result['custom_field'], true),
					'address'           => $this->model_customer_customer->getAddresses($result['customer_id'])
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('customer/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id'])) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_customer_custom_field->getCustomFields(array('filter_customer_group_id' => $customer_group_id));

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => empty($custom_field['required']) || $custom_field['required'] == 0 ? false : true
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function address() {
		$json = array();

		if (!empty($this->request->get['address_id'])) {
			$this->load->model('customer/customer');

			$json = $this->model_customer_customer->getAddress($this->request->get['address_id']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

    public function visit_info() {
        $this->load->language('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('customer/customer');

        $data['heading_title'] = '回访调查详情';
        $data['text_list'] = '回访调查内容';
        $data['text_no_results'] = '没有回访信息';
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');

		if( $this->user->getGroupId() == 11 ) {
		    $data['header'] = $this->load->view('common/onlyheader');
			$data['column_left'] = "";
		    $data['footer'] = "";
		} else {
			$data['header'] = $this->load->controller('common/header');
		    $data['column_left'] = $this->load->controller('common/column_left');
		    $data['footer'] = $this->load->controller('common/footer');
		}



        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => '首页',
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  '会员列表',
            'href' => $this->url->link('customer/customer', '', true)
        );

        $data['infos'] = array();

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = null;
            $this->response->setOutput($this->load->view('error/not_found', $data));
        }

        $this->load->model('customer/customer');
        $log = new Log('sql2.log');
        $log->write($customer_id);


        $results = $this->model_customer_customer->getReceiptByCustomerId($customer_id);

        if($results){
            foreach($results as $result)
            {
                if(json_decode($result['receipt_text'],true)['receipt']){
                    $receipt_text=array(json_decode($result['receipt_text'],true)['receipt']);
                }else{
                    $receipt_text=NULL;
                }
                $data['infos'][] = array(
                    'receipt_history_id' => $result['receipt_history_id'],
                    'receipt_id' => $result['receipt_id'],
                    'customer_id' => $result['customer_id'],
                    'receipt_status' => $result['receipt_status'],
                    'receipt_text' => $receipt_text,
                    'date_add' => $result['date_add']
                );

            }

            $log = new Log('json.log');
            foreach ($data['infos'] as $info) {
                if (isset($info['receipt_text'])) {
                    $log->write('if*****');
                    foreach ($info['receipt_text'][0] as $onereceipt) {
                        if ( $onereceipt['flag'] == '1' ) {
                            $log->write($onereceipt['name']);

                            if ($onereceipt['detail']) {
                                if (isset($onereceipt['detail']['key'])) {
                                    if ($onereceipt['detail']['value'] == '有') {
                                        $log->write($onereceipt['detail']['key']);
                                    } else if ($onereceipt['detail']['value'] != '无') {
                                        $log->write($onereceipt['detail']['key']);
                                        $log->write($onereceipt['detail']['value']);
                                    }
                                } else {
                                    $log->write(sizeof($onereceipt['detail']));
                                    foreach ($onereceipt['detail'] as $onedetail) {
                                        if ($onedetail['value'] == '有') {
                                            $log->write($onedetail['key']);
                                        } else if ($onedetail['value'] != '无') {
                                            $log->write($onedetail['key']);
                                            $log->write($onedetail['value']);
                                        }
                                    }
                                }
                            }

                        } else{
                            $log->write('flag=0:x');
                        }

                    }
                }else{
                    $log->write('if#########');
                }
            };

        };

        $this->response->setOutput($this->load->view('customer/customer_visit_info', $data));
    }
}

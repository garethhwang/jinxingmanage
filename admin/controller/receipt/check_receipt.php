<?php
/**
 * Created by PhpStorm.
 * User: renxiaopeng
 * Date: 2017/3/13
 * Time: 14:36
 */
class ControllerReceiptCheckReceipt extends Controller
{
    public function index() {
        try{
            $this->load->language('receipt/check_receipt');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('receipt/check_receipt');

            $this->getList();
        }
        catch(Exception $e){
            $this->response->setOutput($e->getMessage());
        }
    }

    protected function getList()
    {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('receipt/check_receipt', 'token=' . $this->session->data['token'], true)
        );

        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
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

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'name';
        }

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_date_added' => $filter_date_added,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $data['receipts'] = array();

        $receipt_total = $this->model_receipt_check_receipt->getTotalCustomersNear($filter_data);

        $results = $this->model_receipt_check_receipt->getAllCustomersNear($filter_data);

        if(!empty($results)){
            foreach ($results as $result) {
                $receiptdate = $result['receiptdate'];
                $today = date($this->language->get('date_format_short'));
                $d1 = strtotime($receiptdate);
                $d2 = strtotime($today);
                $Days = 7 - round(($d2 - $d1) / 3600 / 24);

                if ($Days < 3) {
                    $urgency = 3;
                } else if ($Days < 5) {
                    $urgency = 2;
                }else if ($Days >= 5) {
                    $urgency = 1;
                }

                $data['receipts'][] = array(
                    'customer_id'    => $result['customer_id'],
                    'name'        => $result['name'],
                    'telephone'    => $result['telephone'],
                    'receiptdate' => $result['receiptdate'],
                    'days'        => $Days,
                    'urgency'     => $urgency
                );
            }
        }
        $pagination = new Pagination();
        $pagination->total = $receipt_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('receipt/check_receipt', 'token=' . $this->session->data['token']. '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($receipt_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($receipt_total - $this->config->get('config_limit_admin'))) ? $receipt_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $receipt_total, ceil($receipt_total / $this->config->get('config_limit_admin')));
        $data['filter_name'] = $filter_name;
        $data['filter_date_added'] = $filter_date_added;
        $data['sort'] = $sort;

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
        $data['column_telephone'] = $this->language->get('column_telephone');
        $data['column_customer_group'] = $this->language->get('column_customer_group');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_approved'] = $this->language->get('column_approved');
        $data['column_ip'] = $this->language->get('column_ip');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_office'] = $this->language->get('column_office');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['office_name'] = $this->language->get('office_name');

        $data['button_approve'] = $this->language->get('button_approve');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_visit_info'] = '回访信息查询';
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_login'] = $this->language->get('button_login');
        $data['button_unlock'] = $this->language->get('button_unlock');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['token'] = $this->session->data['token'];

        $data['sort_name'] = $this->url->link('receipt/check_receipt', 'token=' . $this->session->data['token'] . '&sort=name', true);
        $data['sort_date_added'] = $this->url->link('receipt/check_receipt', 'token=' . $this->session->data['token'] . '&sort=receiptdate', true);


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('receipt/check_receipt', $data));
    }

    public function visit_info() {
        $this->load->language('receipt/receipt');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('receipt/receipt');

        $data['heading_title'] = '回访调查详情';
        $data['text_list'] = '回访调查内容';
        $data['text_no_results'] = '没有回访信息';
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => '首页',
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' =>  '新增回访调查',
            'href' => $this->url->link('receipt/receipt', '', true)
        );

        $data['infos'] = array();

        if (isset($this->request->get['receipt_history_id'])) {
            $receipt_history_id = $this->request->get['receipt_history_id'];
        } else {
            $receipt_history_id = null;
        }

        $this->load->model('receipt/receipt');
        $log = new Log('sql2.log');
        $log->write($receipt_history_id);
        $result = $this->model_receipt_receipt->getReceiptByReceipt_history_Id($receipt_history_id);

        if(isset($result)){
            if(json_decode($result['receipt_text'],true)['receipt']){
                $receipt_text=array(json_decode($result['receipt_text'],true)['receipt']);
            }else{
                $receipt_text=NULL;
            }
            $data['info'] = array(
                'receipt_history_id' => $result['receipt_history_id'],
                'receipt_id' => $result['receipt_id'],
                'customer_id' => $result['customer_id'],
                'receipt_status' => $result['receipt_status'],
                'receipt_text' => $receipt_text,
                'date_add' => $result['date_add']
            );
        }


        $this->response->setOutput($this->load->view('receipt/receipt_visit_info', $data));
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: renxiaopeng
 * Date: 2017/3/9
 * Time: 16:29
 */

class ModelReceiptReceipt extends Model {
    public function getTotalReceipts($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "receipt_history WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) <=date(date_add)";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(date_add) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        if ($implode) {
            $sql .= " WHERE " . implode(" AND ", $implode);
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    public function getAllReceipts($data = array()) {
        $sql = "SELECT a.customer_id, a.receipt_history_id, a.receipt_status, a.receipt_text, a.date_add, b.realname AS name, b.telephone FROM " . DB_PREFIX . "receipt_history AS a, " . DB_PREFIX . "customer AS b WHERE a.customer_id = b.customer_id AND DATE_SUB(CURDATE(), INTERVAL 7 DAY) <=date(a.date_add)";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(b.realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(a.date_add) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }

        $sort_data = array(
            'name',
            'a.date_add'
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
    public function getReceiptByReceipt_history_Id($Receipt_history_Id){
        $receipt_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "receipt_history WHERE receipt_history_id = '" . (int)$Receipt_history_Id . "'");
        return $receipt_query->row;
    }

    public function getLastdateByCustomerId($customer_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "physical WHERE customer_id = '" . (int)$customer_id . "'");
        return $query->row['lastmenstrualdate'];
    }

    public function updateReceiptdate($date, $customer_id){
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET receiptdate = '" . $date . "' WHERE customer_id = '" . (int)$customer_id . "'");
    }

    public function deleteReceiptHistoryRecord($receipt_history_id){
        $this->db-query("DELETE FROM " . DB_PREFIX . "receipt_history WHERE receipt_history_id = '" . (int)$receipt_history_id ."'" );
    }
}

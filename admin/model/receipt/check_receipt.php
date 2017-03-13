<?php
/**
 * Created by PhpStorm.
 * User: renxiaopeng
 * Date: 2017/3/13
 * Time: 17:15
 */

class ModelReceiptCheckReceipt extends Model {
    public function getTotalCustomersNear($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) <=date(receiptdate) AND CURDATE() > date(receiptdate) AND ispregnant = 1";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(receiptdate) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        if ($implode) {
            $sql .= " WHERE " . implode(" AND ", $implode);
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    public function getAllCustomersNear($data = array()) {
        $sql = "SELECT customer_id, realname AS name, telephone, receiptdate FROM " .DB_PREFIX . "customer WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) <=date(receiptdate) AND CURDATE() > date(receiptdate) AND ispregnant = 1";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(realname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(receiptdate) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }

        $sort_data = array(
            'name',
            'receiptdate'
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
}

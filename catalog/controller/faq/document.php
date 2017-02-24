<?php
class ControllerFaqDocument extends Controller {
	public function index() {
        $this->document->setTitle("帮助手册");

        $log = new Log("wechat.log");
        $data["error_warning"] = "";

        if (isset($this->request->get['document_id'])) {
            $document_id = (int)$this->request->get['document_id'];
        } else {
            $document_id = 0;
        }

        // Faq Category Menu
        $this->load->model('faq/document');
        $results = $this->model_faq_document->getDocumentById($document_id);

        foreach ($results as $result) {

            $data['documents'][] = array(
                'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
                'answer'       		=> html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8'),
            );

        }

        $data['header'] = $this->load->controller('common/wechatheader');

        $this->response->setOutput($this->load->view('faq/document', $data));
	}
}
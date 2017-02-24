<?php
class ControllerFaqDocuments extends Controller {
	public function index() {

        // Faq Category Menu
        $this->load->model('faq/document');
        $results = $this->model_faq_document->getDocuments();

        foreach ($results as $result){
            $data['documents'][] = array(
                'faq_id' => $result['faq_id'],
                'title' => $result['title'],
                'href' => $this->url->link('faq/document','&document_id=' . $result['faq_id'] )
                //'href' => $this->url->link('wechat/wechatproduct')
            );
        }


        $this->document->setTitle("帮助手册");
       // $data['title'] = "帮助手册";
        $data['header'] = $this->load->controller('common/wechatheader');


        $this->response->setOutput($this->load->view('faq/documents', $data));
	}
}
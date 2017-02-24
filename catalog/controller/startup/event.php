<?php
class ControllerStartupEvent extends Controller {
	public function index() {
        $log = new Log("router.log");
        $log->write("Enter catalog event.php");

		// Add events from the DB
		$this->load->model('extension/event');
		
		$results = $this->model_extension_event->getEvents();
		
		foreach ($results as $result) {
			$this->event->register(substr($result['trigger'], strpos($result['trigger'], '/') + 1), new Action($result['action']));
		}
	}
}

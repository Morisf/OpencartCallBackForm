<?php

class ControllerModuleFeedback extends Controller
{
    public function index($setting)
    {
        static $module = 0;

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->request->post['email']);
            $mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
            $mail->setText($this->request->post['phone']);

            try {
                $mail->send();
                return json_encode(['status' => 'fail']);
            } catch (Exception $e) {
                return json_encode(['status' => 'failed']);
            }
        }

        $this->load->language('module/feedback');

        $this->load->model('design/banner');
        $this->load->model('tool/image');

        $this->document->addStyle('catalog/view/theme/default/stylesheet/feedback.css');
        $this->document->addScript('catalog/view/javascript/feedback.js');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_phone'] = $this->language->get('entry_phone');
        $data['entry_name_placeholder'] = $this->language->get('entry_name_placeholder');
        $data['entry_email_placeholder'] = $this->language->get('entry_email_placeholder');
        $data['entry_phone_placeholder'] = $this->language->get('entry_phone_placeholder');
        $data['entry_submit'] = $this->language->get('entry_submit');
        $data['top_text'] = html_entity_decode($setting['top_text']);
        $data['head_text'] = html_entity_decode($setting['head_text']);
        $data['addition_text'] = html_entity_decode($setting['addition_text']);
        $data['min_height'] = $setting['height'];
        $data['min_width'] = $setting['width'];

        $data['banners'] = array();

        $results = $this->model_design_banner->getBanner($setting['banner_id']);

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $data['bacgroudImage'] = [
                    'title' => $result['title'],
                    'link' => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                ];
            }
        }

        $data['module'] = $module++;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/feedback.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/feedback.tpl', $data);
        } else {
            return $this->load->view('default/template/module/feedback.tpl', $data);
        }
    }
}

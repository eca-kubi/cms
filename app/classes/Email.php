<?php

/**
 * User short summary.
 *
 * User description.
 *
 * @version 1.0
 * @author UNCLE CHARLES
 */
class Email implements \JsonSerializable
{
    public $email_id;
    public $subject;
    public $body;
    public $recipient_user_id;
    public $status;
    public $created;
    public $sender_user_id;

    public function __construct($email_id)
    {
        $this->email_id = $email_id;
        $this->email_model = new EmailModel();
        $email = $this->email_model->getEmail($email_id);
        $this->email_id = $email->email_id;
        $this->subject = $email->subject;
        $this->body = $email->body;
        $this->recipient_user_id = $email->recipient_user_id;
        $this->created = $email->created;
        $this->status = $email->status;
    }

    public function jsonSerialize(){
        return [
            'body' => $this->body,
            'subject' => $this->subject
        ];
    }
}
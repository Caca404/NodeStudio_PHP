<?php
	
	namespace App\Model;

	use PHPMailer\PHPMailer\PHPMailer;
	use stdClass;

	class Email{
		private $mail;
		private $data;
		private $error;

		public function __construct(){
			$this->mail = new PHPMailer(true);
			$this->data = new stdClass();

			$this->mail->IsSMTP();
			$this->mail->IsHTML();
			$this->mail->SetLanguage("br");

			$this->mail->SMTPAuth = true;
			$this->mail->SMTPSecure = "ssl";
			$this->mail->Charset = "utf-8";

			$this->mail->Host = "smtp.gmail.com";
			$this->mail->Port = "465";
			$this->mail->Username = "php.teste10kk@gmail.com";
			$this->mail->Password = "Php123TI";
		}

		public function add(string $subject, string $body, string $recipient_name, string $recipient_email) : Email
		{
			$this->data->subject = $subject;
			$this->data->body = $body;
			$this->data->recipient_name = $recipient_name;
			$this->data->recipient_email = $recipient_email;
			return $this;
		}

		public function attach(string $filePath, string $fileName) : Email{
			$this->data->attach[$filePath] = $fileName;
			return $this;
		}

		public function send(string $from_name, string $from_email) : bool
		{
			try{
				$this->mail->Subject = $this->data->subject;
				$this->mail->MsgHTML($this->data->body);
				$this->mail->AddAddress($this->data->recipient_email, $this->data->recipient_name);
				$this->mail->SetFrom($from_email, $from_name);

				// if(!empty($this->data->attach)){
				// 	foreach ($this->data->attach as $path => $name) {
				// 		$this->mail->addAttachment($path,$name);
				// 	}
				// }

				return $this->mail->Send();
			}
			catch(Exception $e){
				$this->error = $e;
				return false;
			}
		}

		public function error() : ?Exception{
			return $this->error;
		}
	}
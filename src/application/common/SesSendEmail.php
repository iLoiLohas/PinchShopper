<?php
require_once 'aws-sdk-php/autoload.php';
use Aws\Ses\SesClient as SesClient;
use Aws\Common\Enum\Region as Region;
use Aws\Ses\Exception\SesException as SesException;

class SesSendEmail {
	private $_client;
	protected $_charset = 'ISO-2022-JP'; // 変換先の文字コード

	/**
	 * コンストラクタ
	 * 
	 * @param $key        	
	 * @param $secret        	
	 */
	public function __construct($key, $secret) {
		$sesClient = SesClient::factory(array(
				'key'		=> $key,
				'secret'	=> $secret,
				'region'	=> Region::US_EAST_1	// 東京は使えない
				)
		);
		$this->_client	= $sesClient;
	}
	/**
	 * メール送信
	 * 
	 * @param $source        	
	 * @param $dest        	
	 * @param $subject        	
	 * @param $body_text        	
	 */
	public function sendEmail($source, $dest, $subject, $bodyText) {
		try {
			// 添付ファイル無しのメールを送信
			$result = $this->_client->sendEmail(array(
					'Source' => $source,
					'Destination' => array(
							'ToAddresses' => array(
									$dest
							),
							'CcAddresses' => array(),	// CC(あれば)
							'BccAddresses' => array()	// BCC(あれば)
					),
					'Message' => array(
							'Subject' => array(
									'Data'		=> $subject,
									'Charset'	=> $this->_charset
							),
							'Body' => array(
									'Text' => array(
											'Data'		=> $bodyText,
											'Charset'	=> $this->_charset
									),
// 									 'Html' => array(
// 									 		'Data' => $bodyText,
// 									 		'Charset' => $this->_charset,
// 									 ),
							)
					)
			))->toArray();
		} catch(SesException $exc) {
			$result	= $exc->getMessage();
		}
		return $result;
	}
}

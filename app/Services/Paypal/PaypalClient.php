<?php

namespace App\Services\Paypal;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PaypalClient
{
	private $client;
	private $tries;
	private $config;

	public function __construct($config)
	{
		$this->tries = 0;
		$this->config = $config;
		$this->createClient();
	}

	private function createClient()
	{
		$this->client = app('GuzzleClient')([
			'base_uri' => $this->config['test'] === true ? $this->config['test_link'] : $this->config['prod_link'],
			'headers' => [
				'Connection' => 'close',
				'User-Agent' => ''
			],
			'curl' => $this->config['test'] === true ? [
				CURLOPT_FORBID_REUSE => true,
				CURLOPT_HEADER => true,
				CURLINFO_HEADER_OUT => true
			] : [
				CURLOPT_FORBID_REUSE => true
			]
		]);
	}

	/**
	 * @param $link
	 * @param $data
	 * @return mixed
	 * @throws GuzzleException
	 */
	public function post($link, $data)
	{
		return $this->send('POST', $link, ['body' => $data]);
	}

	/**
	 * @param string $method
	 * @param $link
	 * @param $data
	 * @return mixed
	 * @throws GuzzleException
	 */
	private function send(string $method, $link, $data)
	{
		if ($this->tries < 5) {
			try {
				$request = $this->client->request($method, $link, $data);
				$this->tries = 0;
				return $request->getBody();
			} catch (RequestException $e) {

				Log::channel('paypal')->error(
					'Paypal-service http request failed: ' . $link . '.' .
					' - Code: ' . $e->getCode() .
					' - Message: ' . $e->getMessage()
				);
				++$this->tries;

				$this->send($method, $link, $data);
			}
		}
	}
}
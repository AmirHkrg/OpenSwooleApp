<?php

class Cli
{
    protected function get_options(): void
    {
        $options = getopt("S:");
        foreach ($options as $key => $value) {
            $options[$key] = strtolower($value);
        }

        if ($options["S"]) {
            $this->validate_url($options);
        }
    }

    private function extract_start_option($options): array
    {
        $data = $options["S"];

        $data = explode("--", $data);
        $urlParts = parse_url($data[0]);

        if (isset($urlParts['scheme'])) {
            $domain = $urlParts['scheme'] . "://" . $urlParts['host'];
        } else {
            $domain = $urlParts['host'];
        }

        $port = $urlParts['port'];
        $fileName = $data[1];


        return [
            'domain' => $domain,
            'port' => $port,
            'filename' => $fileName
        ];
    }

    protected function validate_url($options)
    {
        $data = $this->extract_start_option($options);
        $domain = $data['domain'];
        $port = $data['port'];
        $fileName = $data['filename'];

        if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'php') {
            echo "The selected file must be php";
            exit();
        }
        if (filter_var($domain, FILTER_VALIDATE_IP) === false || filter_var($domain, FILTER_VALIDATE_URL) === false) {

        } else {
            echo "The URL entered is not valid";
            exit();
        }

        global $server_config;
        $server_config['cli']['address'] = $domain;
        $server_config['cli']['port'] = $port;
        $server_config['cli']['filename'] = $fileName;
        require_once $fileName;
    }
}
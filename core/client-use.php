<?php

class Cli
{
    protected function get_options()
    {
        $options = getopt("S:");
        foreach ($options as $key => $value) {
            $options[$key] = strtolower($value);
        }
        $this->validate_url($options);
    }

    private function extract_start_option($options): array
    {
        $data = $options["S"];

        $data = explode("--", $data);
        $urlParts = parse_url($data[0]);

        $domain = $urlParts['scheme'] . "://" . $urlParts['host'];
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

        if (pathinfo($fileName, PATHINFO_EXTENSION) === 'php') {
            $validFile = true;
        } else {
            $validFile = false;
        }

        if (filter_var($domain, FILTER_VALIDATE_IP) || filter_var($domain, FILTER_VALIDATE_URL)) {
            $validUrl = true;
        } else {
            $validUrl = false;
        }

        if ($validFile && $validUrl) {
            global $server_config;
            $server_config['cli']['address'] = $domain;
            $server_config['cli']['port'] = $port;
            $server_config['cli']['filename'] = $fileName;
            exec('php ' . $fileName);
        } else {
            return false;
        }
    }
}
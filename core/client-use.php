<?php

class Cli
{
    protected function get_options(): void
    {
        $options = getopt("S:h::v::", ["help"]);
        foreach ($options as $key => $value) {
            $options[$key] = strtolower($value);
        }

        if (isset($options["S"])) {
            $this->validate_url($options);
        }

        if (isset($options["h"]) || isset($options["help"])){
            $this->help();
        }

        if (isset($options["v"])) {
            $this->version();
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

//        var_dump($data);

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

    private function version(){
        echo "OpenSwooleApp version : 1.0.0" . PHP_EOL;
    }

    protected function help(){
        $help =
            "Usage: php cli [-Option] [...Parameters]" . PHP_EOL .
            "Options are:" . PHP_EOL .
            "    -S         Address:Port--Filename  Start Server" . PHP_EOL .
            "    -h --help                          Help" . PHP_EOL .
            "    -v                                 Version info" . PHP_EOL .
            PHP_EOL
        ;
        echo $help;
    }
}
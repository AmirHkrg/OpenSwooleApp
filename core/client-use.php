<?php

class Cli
{
    private function get_options(): array
    {
        $options = getopt("S:");
        foreach ($options as $key => $value) {
            $options[$key] = strtolower($value);
        }
        return $options;
    }

    private function extract_start_option(): array
    {
        $options = $this->get_options();
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

    private function validate_url(): bool
    {
        $data = $this->extract_start_option();
        $domain = $data['domain'];
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
            return true;
        } else {
            return false;
        }
    }

    public function set_options()
    {
        if ($this->validate_url()) {
            $options = $this->extract_start_option();

            global $server_config;
            $server_config['cli']['address'] = $options['domain'];
            $server_config['cli']['port'] = $options['port'];
            $server_config['cli']['filename'] = $options['filename'];
        } else {
            return false;
        }
    }

    protected function run_cli(): void
    {
        global $server_config;
        exec('php ' . $server_config['cli']['filename']);
    }
}
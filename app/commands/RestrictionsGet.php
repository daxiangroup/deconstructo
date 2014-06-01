<?php

use DaxianGroup\Restrictions\Parsers\RestrictionsParser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RestrictionsGet extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'restrictions:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs the construction restrictions from the Open Data feed.';

    /**
     * The Curl Handler used to commuicate with Open Data.
     *
     * @var object
     */
    private $curlHandler;

    /**
     * The results obtained from the Open Data source
     *
     * @var string
     */

    private $result;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->initializeCurlHandler();
        $this->setCurlOptions();
        $this->getRestrictions();
        $this->processRestrictions();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    /*
    protected function getArguments()
    {
        return array(
            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }
    */

    /**
     * Get the console command options.
     *
     * @return array
     */
    /*
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }
    */

    private function initializeCurlHandler()
    {
        $this->curlHandler = curl_init(Config::get('restrictions.restrictions_url'));
    }

    private function setCurlOptions()
    {
        curl_setopt($this->curlHandler, CURLOPT_HEADER,         false);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
    }

    private function getRestrictions()
    {
        $this->result = curl_exec($this->curlHandler);
        curl_close($this->curlHandler);

    }

    private function processRestrictions()
    {
        $restrictions = new RestrictionsParser($this->result);
        $restrictions->parse();
    }

}

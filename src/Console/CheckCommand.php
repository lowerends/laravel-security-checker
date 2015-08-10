<?php namespace Lowerends\SecurityChecker\Console;

use Illuminate\Console\Command;
use SensioLabs\Security\SecurityChecker;

class CheckCommand extends Command
{
    protected $name = 'security:check';

    protected $description = 'Check your Laravel project for known security issues';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $checker = new SecurityChecker();

        $alerts = $checker->check(base_path() . '/composer.lock');

        if (!empty($alerts))
        {
            foreach ($alerts as $package => $alert)
            {
                $this->error('Security issues found!');

                $this->info('======================');

                $this->info('Package: ' . $package);

                foreach ($alert['advisories'] as $advisory)
                {
                    $this->info('Version: ' . $alert['version']);

                    $this->info('Title: ' . $advisory['title']);
                    
                    $this->info('Link: ' . $advisory['link']);

                    if($advisory['cve'] != "")
                    {
                        $this->info('CVE: ' . $advisory['cve']);
                    }
                }
            }

        }
        else
        {
            $this->info('No security issues found!');
        }
    }
}

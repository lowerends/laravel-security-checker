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

        $alerts = $checker->check(base_path() . 'composer.lock');

        if (!empty($alerts)) {
            foreach ($alerts as $alert) {
                $this->alert('Security issue found: ' . $alert);
            }

        } else {
            $this->info('No security issues found!');
        }
    }
}

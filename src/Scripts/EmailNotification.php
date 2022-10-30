<?php

declare(strict_types=1);

namespace Juliangorge\Notifications\Scripts;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class EmailNotification extends Command
{
    
    protected $em;
    protected $config;
    protected $plugin;

    public function __construct($em, $config)
    {
        $this->em = $em;
        $this->config = $config;
        $this->plugin = new \Juliangorge\Notifications\Plugin\NotificationsPlugin($em, $config);

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $start = microtime(true);

        $results = $this->plugin->sendPendingMails();
        
        $output->writeln('Tiempo en ejecución: ' . round(microtime(true) - $start, 2) . ' segundos');

        $has_errors = (sizeof($results['errors']) > 0);
        if($has_errors){
            $mail = new \Juliangorge\Mail\Mail($this->config);
            $mail->send($this->config['mail_errors'], 
                'CRON: Error al actualizar', 
                '<pre>' , print_r($results['errors']) , '</pre>',
                false);
            return Command::FAILURE;
        }

        $output->writeln('Enviados: ' . $results['sent'] . ', errors: ' . sizeof($results['errors']));
        return Command::SUCCESS;
    }
}
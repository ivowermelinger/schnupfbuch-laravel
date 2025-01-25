<?php

namespace App\Console\Commands;

use App\Models\Line;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddNewLines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-lines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds lines from 25.01.2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {	
        $this->info('Starting adding lines');
        $admin = User::where('email', getenv('ADMIN_EMAIL'))->first();

        if (!$admin) {
            $this->error('Admin user not found. Please check ADMIN_EMAIL in your .env file.');
            return 1;
        }

        // <br/>
        $newLines = [
            'Wenn mögli, de vögli.<br/>Wenn nöd, isch blöd!',
            'Gerade als er gerade war<br/>knickte er, was schade war.',
            'Willst du scheissen ohne Kraft,<br/>dann trinke Ramseier Apfelsaft.',
            'Klebt der Bauer an der Mauer,<br/>war der Stier ein bisschen sauer!',
            'Warum heissen Teigwaren Teigwaren,<br/>weil sie früher Teig waren.',
            'Siehst du im Estrich die Frösche leichen,<br/>ist dies gewiss ein Hochwasserzeichen.',
            'Auf jedem Schiff dass dampft und segelt<br/>gibts jemanden der die Putzfau vögelt.<br/>Ist das Schiff auch noch so klein,<br/>jemand muss mal die Putzfrau sein.',
            'Lieber ned ernst gno wärde,<br/>als vom Ernst gno wärde.',
            'Lieber ufem chaute Bode hocke,<br/>statt mit chaute Hode bocke!',
            'Gott sprach zu Moses,<br/>stiig ab em Velo und stoss es!',
            'Haschte schnupf in der Blutbahn,<br/>kanschte ficken wie ein Truthahn!',
            'Nur wer die liebe kennt,<br/>weiss wie der Tripper brennt!',
            'Links ein Baum,<br/>rechts ein Baum<br/>und in der Mitte,<br/>man glaubt es kaum,<br/>auch ein Baum!',
            'Fällt der Bauer Tod vom Traktor,<br/>war er zu nah am Kernreaktor.',
            'Es esch ned meis,<br/>es esch ned deis,<br/>es esch im Matheis seis!',
            'Lieber es Schnitzel im Teller,<br/>als bim Fritzl im Chäller.',
            'Egal öb Hund, Chatz oder Muus,<br/>McDonalds macht en Burger druus.',
            'Fällt der Bauer vom Trecker,<br/>war der Schnaps wohl wieder lecker.'

        ];

        $addedCount = 0;
        $totalLines = count($newLines);

        $this->output->progressStart($totalLines);

        foreach ($newLines as $line) 
        {
            try {
                Line::create([
                    'line' => $line,
                    'active' => true,
                    'user_id' => $admin->id,
                ]);
                $addedCount++;
                $this->output->progressAdvance();
            } catch (\Exception $e) {
                $this->error("Failed to add line: " . substr($line, 0, 30) . "...");
                Log::error("Failed to add line in AddNewLines command: " . $e->getMessage());
            }
        }

        $this->output->progressFinish();

        $this->info("Operation completed. Added $addedCount out of $totalLines lines.");
        
        if ($addedCount === $totalLines) {
            $this->info('All lines were successfully added to the database.');
        } else {
            $this->warn("Some lines were not added. Please check the logs for more information.");
        }

        return 0;
    }
}

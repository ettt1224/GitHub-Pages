<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\intro;
use function Laravel\Prompts\outro;
use function Termwind\render;

class ViewResume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resume:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '查看互動式個人履歷';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = config('resume');
        
        intro("歡迎來到 {$data['name']} 的互動式個人履歷");

        while (true) {
            $choice = select(
                label: '你想了解什麼？',
                options: [
                    'about'    => '👤 關於我',
                    'skills'   => '🛠️ 技術棧',
                    'projects' => '🚀 精選專案',
                    'contact'  => '📧 聯絡方式',
                    'exit'     => '👋 離開',
                ],
                default: 'about'
            );

            if ($choice === 'exit') {
                outro('感謝您的觀看！再見！');
                break;
            }

            $this->renderSection($choice, $data);
        }
    }

    private function renderSection(string $section, array $data)
    {
        switch ($section) {
            case 'about':
                render(<<<HTML
                    <div class="mx-2 my-1">
                        <div class="bg-blue-600 text-white px-1 font-bold">👤 關於我 / ABOUT ME</div>
                        <div class="mt-1">
                            {$data['bio']}
                        </div>
                    </div>
HTML);
                break;

            case 'skills':
                $skillsHtml = collect($data['skills'])->map(function($skill) {
                    return "<li><span class='font-bold text-blue-400'>{$skill['name']}:</span> {$skill['level']}</li>";
                })->implode('');

                render(<<<HTML
                    <div class="mx-2 my-1">
                        <div class="bg-green-600 text-white px-1 font-bold">🛠️ 技術棧 / SKILLS</div>
                        <div class="mt-1">
                            <ul class="list-disc">
                                {$skillsHtml}
                            </ul>
                        </div>
                    </div>
HTML);
                break;

            case 'projects':
                $projectsHtml = collect($data['projects'])->map(function($project) {
                    return "
                        <div class='mb-1'>
                            <span class='text-yellow-400 font-bold'>📂 {$project['name']}</span>
                            <p class='ml-2'>{$project['desc']}</p>
                        </div>
                    ";
                })->implode('');

                render(<<<HTML
                    <div class="mx-2 my-1">
                        <div class="bg-purple-600 text-white px-1 font-bold">🚀 精選專案 / PROJECTS</div>
                        <div class="mt-1">
                            {$projectsHtml}
                        </div>
                    </div>
HTML);
                break;

            case 'contact':
                render(<<<HTML
                    <div class="mx-2 my-1">
                        <div class="bg-red-600 text-white px-1 font-bold">📧 聯絡方式 / CONTACT</div>
                        <div class="mt-1">
                            <div class="flex space-x-1">
                                <span class="font-bold">GitHub:</span>
                                <span class="text-blue-400">{$data['contact']['github']}</span>
                            </div>
                            <div class="flex space-x-1">
                                <span class="font-bold">Email:</span>
                                <span class="text-blue-400">{$data['contact']['email']}</span>
                            </div>
                        </div>
                    </div>
HTML);
                break;
        }
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}

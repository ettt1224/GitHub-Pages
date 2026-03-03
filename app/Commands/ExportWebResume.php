<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class ExportWebResume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resume:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '將履歷匯出為現代化的 HTML 網頁';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        spin(
            function () {
                // 1. 取得資料
                $data = config('resume');

                if (!$data) {
                    error('找不到 config/resume.php 資料檔案！');
                    return;
                }

                // 2. 渲染 Blade 模板
                // Laravel Zero 的 View 預設需要指定路徑
                $html = view('resume-web', $data)->render();

                // 3. 儲存檔案
                File::put(base_path('index.html'), $html);

                // 模擬處理時間
                sleep(1);
            },
            '正在產出 HTML 網頁履歷...'
        );

        info('✅ 匯出成功！檔案已儲存為 index.html');
        info('💡 您可以直接用瀏覽器打開此檔案，或部署到 GitHub Pages。');
    }
}

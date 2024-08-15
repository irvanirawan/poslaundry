<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EditFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:edit-file-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit File Masal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->editFileMasal2();
    }

    /**
     * Edit File Masal
     */
    public function editFileMasal()
    {
        $this->info('Start');

        // Path ke direktori Modules
        $modulesPath = 'Modules';

        // Memeriksa apakah direktori Modules ada
        if (!is_dir($modulesPath)) {
            $this->error("Directory 'Modules' does not exist.");
            return;
        }

        // Mendapatkan semua direktori di dalam direktori Modules
        $modules = array_filter(glob($modulesPath . '/*'), 'is_dir');

        // Jika tidak ada direktori dalam Modules
        if (empty($modules)) {
            $this->error("No modules found in 'Modules' directory.");
            return;
        }

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $this->info("Processing module: $moduleName");

            // Mencari file model berdasarkan nama module
            $modelPath = "$module/app/Models/$moduleName.php";
            if (file_exists($modelPath)) {
                // Baca isi file
                $fileContents = file_get_contents($modelPath);

                // Ubah 'use HasFactory;' menjadi 'use HasFactory, LogsActivity;'
                $fileContents = str_replace('use HasFactory;', 'use HasFactory, LogsActivity;', $fileContents);

                // Tambahkan LogsActivity trait jika belum ada di import
                if (strpos($fileContents, 'use Spatie\Activitylog\Traits\LogsActivity;') === false) {
                    $fileContents = str_replace(
                        'use Illuminate\Database\Eloquent\Model;',
                        'use Illuminate\Database\Eloquent\Model;' . PHP_EOL . 'use Spatie\Activitylog\Traits\LogsActivity;' . PHP_EOL . 'use Spatie\Activitylog\LogOptions;',
                        $fileContents
                    );
                }

                // Metode yang ingin ditambahkan dengan $moduleName
                $newMethods = <<<EOD

                    public function getActivitylogOptions(): LogOptions
                    {
                        \$LogOptions = LogOptions::defaults();
                        return \$LogOptions->logFillable()->useLogName('model');
                    }

                    public function getDescriptionForEvent(string \$eventName): string
                    {
                        \$string = '';
                        if (\$eventName === 'created') {
                            \$string = "{$moduleName} {\$this->no_order} telah ditambahkan";
                        } elseif (\$eventName === 'updated') {
                            \$string = "{$moduleName} {\$this->no_order} telah diubah";
                        } elseif (\$eventName === 'deleted') {
                            \$string = "{$moduleName} {\$this->no_order} telah dihapus";
                        } elseif (\$eventName === 'restored') {
                            \$string = "{$moduleName} {\$this->no_order} telah dikembalikan";
                        } else {
                            \$string = "{$moduleName} {\$this->no_order} {\$eventName}";
                        }
                        return \$string;
                    }

                    protected static function booted()
                    {
                        static::created(function (\$model) {
                            \$model->created_by = auth()->id();
                        });

                        static::updating(function (\$model) {
                            \$model->updated_by = auth()->id();
                        });
                    }
                EOD;

                // Tambahkan metode baru sebelum penutupan kelas
                if (strpos($fileContents, 'getActivitylogOptions') === false) {
                    $fileContents = preg_replace('/}\s*$/', $newMethods . PHP_EOL . '}', $fileContents);
                }

                // Tulis kembali isi file yang telah diubah jika ada perubahan
                file_put_contents($modelPath, $fileContents);
                $this->info("Updated: $modelPath");
            } else {
                $this->info("File not found: $modelPath");
            }
        }

        $this->info("String replacement process completed.");
    }

    public function editFileMasal2()
    {
        $this->info('Start');

        // Path ke direktori Modules
        $modulesPath = 'Modules';

        // Memeriksa apakah direktori Modules ada
        if (!is_dir($modulesPath)) {
            $this->error("Directory 'Modules' does not exist.");
            return;
        }

        // Mendapatkan semua direktori di dalam direktori Modules
        $modules = array_filter(glob($modulesPath . '/*'), 'is_dir');

        // Jika tidak ada direktori dalam Modules
        if (empty($modules)) {
            $this->error("No modules found in 'Modules' directory.");
            return;
        }

        // String yang akan dicari
        $search = '], function () {';
        // String pengganti
        $replace = ", 'middleware' => ['web_and_api']], function () {";

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $this->info("Processing module: $moduleName");

            // Mencari file api.php di dalam direktori routes
            $routesPath = "$module/routes/api.php";
            if (file_exists($routesPath)) {
                // Baca isi file
                $fileContents = file_get_contents($routesPath);

                // Ganti string dalam isi file
                $newContents = str_replace($search, $replace, $fileContents);

                // Tulis kembali isi file yang telah diubah jika ada perubahan
                if ($newContents !== $fileContents) {
                    file_put_contents($routesPath, $newContents);
                    $this->info("Updated: $routesPath");
                } else {
                    $this->info("No changes: $routesPath");
                }
            } else {
                $this->info("File not found: $routesPath");
            }
        }

        $this->info("String replacement process completed.");
    }

}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\HandlesImports;

class ProcessFileContents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HandlesImports;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $contents;

    public function __construct($contents = [])
    {
      $this->contents = $contents;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $this->import($this->contents);
    }
}

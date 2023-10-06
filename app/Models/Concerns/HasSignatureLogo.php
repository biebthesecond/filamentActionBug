<?php

namespace App\Models\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasSignatureLogo
{
    /**
     * Update the signature logo.
     *
     * @param  \Illuminate\Http\UploadedFile  $logo
     * @return void
     */
    public function updateLogo(UploadedFile $logo)
    {
        tap($this->logo_path, function ($previous) use ($logo) {
            $this->forceFill([
                'logo_path' => $logo->storePublicly(
                    'signature-logos', ['disk' => $this->LogoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->LogoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the signatures logo.
     *
     * @return void
     */
    public function deleteLogo()
    {
        Storage::disk($this->LogoDisk())->delete($this->logo_path);

        $this->forceFill([
            'logo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the signatures logo.
     *
     * @return string
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo_path
            ? Storage::disk($this->LogoDisk())->url($this->logo_path)
            : null;
    }

    /**
     * Get the disk that profile logos should be stored on.
     *
     * @return string
     */
    protected function LogoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}

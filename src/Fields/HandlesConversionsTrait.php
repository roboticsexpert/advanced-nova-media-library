<?php

namespace Ebess\AdvancedNovaMediaLibrary\Fields;

/**
 * @mixin Media
 */
trait HandlesConversionsTrait
{
    public function conversionOnIndexView(string $conversionOnIndexView): self
    {
        return $this->withMeta(compact('conversionOnIndexView'));
    }

    public function conversionOnDetailView(string $conversionOnDetailView): self
    {
        return $this->withMeta(compact('conversionOnDetailView'));
    }

    public function conversionOnForm(string $conversionOnForm): self
    {
        return $this->withMeta(compact('conversionOnForm'));
    }

    public function conversionOnPreview(string $conversionOnPreview): self
    {
        return $this->withMeta(compact('conversionOnPreview'));
    }

    public function getConversionUrls(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): array
    {

        return [
            // original needed several purposes like cropping
            '__original__' => $media->getFullUrl(),
            'indexView' =>$media->getFullUrl($this->getConversionForMete($media,'conversionOnIndexView')),
            'detailView' => $media->getFullUrl($this->getConversionForMete($media,'conversionOnDetailView')),
            'form' => $media->getFullUrl($this->getConversionForMete($media,'conversionOnForm')),
            'preview' => $media->getFullUrl($this->getConversionForMete($media,'conversionOnPreview')),
        ];
    }
    private function getConversionForMete(\Spatie\MediaLibrary\MediaCollections\Models\Media $media,string $metaKey){
        if(!isset($this->meta[$metaKey]))
            return '';
        return $media->hasGeneratedConversion($this->meta[$metaKey])?$this->meta[$metaKey]:'';
    }



    public function getTemporaryConversionUrls(\Spatie\MediaLibrary\MediaCollections\Models\Media $media): array
    {
        return [
            // original needed several purposes like cropping
            '__original__' => $media->getTemporaryUrl(),
            'indexView' =>$media->getTemporaryUrl($this->getConversionForMete($media,'conversionOnIndexView')),
            'detailView' => $media->getTemporaryUrl($this->getConversionForMete($media,'conversionOnDetailView')),
            'form' => $media->getTemporaryUrl($this->getConversionForMete($media,'conversionOnForm')),
            'preview' => $media->getTemporaryUrl($this->getConversionForMete($media,'conversionOnPreview')),
        ];
    }
}

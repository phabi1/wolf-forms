<?php

namespace Wolf\Forms\Form;

use Wolf\Core\DependencyInjection\ContainerAwareInterface;
use Wolf\Core\DependencyInjection\ContainerAwareTrait;

class Loader implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load()
    {

        if (!file_exists(WOLF_CORE_CACHE_DIR . '/forms.php')) {
            $forms = $this->getForms();

            $this->prepareCacheDirectory();

            $this->saveCacheForms($forms);
        }
        $forms = include WOLF_CORE_CACHE_DIR . '/forms.php';
        return $forms;
    }

    private function getForms()
    {
        $forms = [];
        $taggedServices = $this->container->getServicesByTag('wolf-forms.form');
        foreach ($taggedServices as $serviceId => $info) {
            $formName = $this->extractFormName($info['tags']);
            if (!$formName) {
                continue;
            }

            $forms[$formName] = $serviceId;
        }
        return $forms;
    }

    private function extractFormName(&$tags)
    {
        foreach ($tags as $tag) {
            if (isset($tag['name']) && $tag['name'] === 'wolf-forms.form' && isset($tag['key'])) {
                return $tag['key'];
            }
        }
        return null;
    }

    private function prepareCacheDirectory()
    {
        $cacheDir = WOLF_CORE_CACHE_DIR;
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
    }

    private function saveCacheForms($forms)
    {
        $cacheFile = WOLF_CORE_CACHE_DIR . '/forms.php';
        $content = "<?php\n\nreturn " . var_export($forms, true) . ";\n";
        file_put_contents($cacheFile, $content);
    }
}

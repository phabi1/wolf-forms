<?php

namespace Wolf\Forms\Form;

class Loader
{
    /**
     * @var bool
     */
    private $loaded = false;

    public function load()
    {
        if ($this->loaded) {
            return;
        }

        if (!file_exists(WOLF_FORMS_PLUGIN_DIR . '/cache/forms.php')) {
            $forms = [];
            apply_filters('wolf_forms_load_forms', $forms);

            $this->prepareCacheDirectory();

            $this->saveCacheForms($forms);
        }

        $this->loaded = true;
    }

    public function reset()
    {
        $cacheFile = WOLF_FORMS_PLUGIN_DIR . '/cache/forms.php';
        if (file_exists($cacheFile)) {
            unlink($cacheFile);
        }
        $this->loaded = false;
    }

    private function prepareCacheDirectory()
    {
        $cacheDir = WOLF_FORMS_PLUGIN_DIR . '/cache';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
    }

    private function saveCacheForms($forms)
    {
        $cacheFile = WOLF_FORMS_PLUGIN_DIR . '/cache/forms.php';
        $content = "<?php\n\nreturn " . var_export($forms, true) . ";\n";
        file_put_contents($cacheFile, $content);
    }
}

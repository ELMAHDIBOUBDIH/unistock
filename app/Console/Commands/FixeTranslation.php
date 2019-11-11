<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DirectoryIterator;
use DB;

use Waavi\Translation\Facades\TranslationCache;

use Storage;

use Artisan;


class FixeTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixe:translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $folders = [
            base_path('app'),//114
            base_path('resources\js\admin\components'),//638
            base_path('resources\views'),//1179
        ];
        $trans = $this->getTrans($folders);

        $languages = DB::table('translator_languages')->get();
        foreach ($languages as $language) {
            $this->deleteNonNeededTrans($trans, $language->locale);
            $this->addNeededTrans($trans, $language->locale);
        }
        $this->flushTrans();
    }
    public function getTrans($folders)
    {
        $trans = [];

        foreach ($folders as $folder) {
            $dir = $folder ;
            foreach (glob("$dir/*") as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['php', 'vue'])) {
                    $content = file_get_contents("$file");
                    preg_match_all('/trans\(\'[a-zA-Z0-9_.-]+\'/', $content, $matches, 0);
                    foreach ($matches[0] as $matche) {
                        $item = [];
                        $exp = explode("'", $matche);
                        $exp2 = explode(".", $exp[1]);
                        $item['group'] = $exp2[0];
                        $item['item'] = $exp2[1];
                        $trans[] = $item;
                    }
                }else{
                    $trans = array_merge($trans, $this->getTrans([$file]));
                }
            }
        }

        return $trans;
    }
    public function deleteNonNeededTrans($trans, $language)
    {
        $translations = DB::table('translator_translations')->where('locale', $language )->whereIn('group', ['messages', 'text', 'seo'])->get();
        $collection = collect($trans);
        foreach ($translations as $translation) {

            $needed = $collection->where('group', $translation->group)->where('item', $translation->item )->first();

            if(is_null($needed)){
              $this->info($translation->group . '.' . $translation->item);
                DB::table('translator_translations')->where('id',$translation->id)->delete();
            }
        }
    }
    public function addNeededTrans($trans, $language)
    {
        foreach ($trans as $tran) {
            $translation = DB::table('translator_translations')->where('group', $tran['group'])->where('item', $tran['item'] )->where('locale', $language )->first();
            if(is_null($translation)){
                $this->info($tran['group'] . '.' . $tran['item']);
                DB::table('translator_translations')->insert(['group'=> $tran['group'], 'item' => $tran['item'], 'text' => str_replace('-' , ' ', $tran['item']) , 'locale' => $language]);
            }

        }
    }

    public function flushTrans()
    {
        TranslationCache::flushAll();

        $languages = DB::table('translator_languages')->get();

          foreach ($languages as $language) {
            $comp_trans = [];
            foreach (DB::table('translator_translations')->where('locale', $language->locale)->where('group', 'text')->get() as $translation) {
                $comp_trans[$translation->item] = $translation->text;
            }
            $text = json_encode($comp_trans);

            $mess_trans = [];
            foreach (DB::table('translator_translations')->where('locale', $language->locale)->where('group', 'messages')->get() as $translation) {
                $mess_trans[$translation->item] = $translation->text;
            }
            $messages = json_encode($mess_trans);

            $seo_trans = [];
            foreach (DB::table('translator_translations')->where('locale', $language->locale)->where('group', 'seo')->get() as $translation) {
                $seo_trans[$translation->item] = $translation->text;
            }
            $seo = json_encode($seo_trans);

            Storage::disk('public_html')->put('js/trans/'.$language->locale.'/admin.js', 'window.trans = {"text" : ' .$text. ',"seo" : ' .$seo. ', "messages" : ' .$messages. '}');
        }

        Artisan::call('cache:clear');

    }
}

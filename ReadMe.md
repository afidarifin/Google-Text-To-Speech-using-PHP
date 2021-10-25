### How To Use
> "<?php
/**
 * @package Google Text To Speech Translate
 * @author  Afid Arifin
 * @version v1.0
 * @web     https://github.com/afidarifin
 */

require_once 'app/classes/class.google_tts.php';

$tts = new Google_TTS();
$audio = $tts->audio([
  'path'         => 'app/resources',
  'lang'         => 'id',
  'audio_format' => 'mp3',
  'file_name'    => time(),
  'text'         => 'Selamat datang di www.afidbara.com',
]);

if($audio) {
  echo 'Successfully to generate text.';
} else {
  echo 'Failed to generate text.';
}
?>"

### Showing files
> "$tts->show_files('app/resources');"

### Empty files
> "$tts->remove_audio('app/resources)"
<?php
/**
 * @package Google Text To Speech Translate
 * @author  Afid Arifin
 * @version v1.0
 * @web     https://github.com/afidarifin
 */

class Google_TTS {
  /**
   * Settings for the audio system before processing.
   * Please read our documentation for more details on audio settings.
   */
  private $file;
  public function audio(array ...$audio): bool {
    /**
     * Checks whether the audio storage path or folder is available or not.
     */
    if(!is_dir($audio[0]['path'])) {
      mkdir($audio[0]['path']);
    }

    /**
     * Get audio file from Google Text To Speech URL.
     */
    $this->file = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&q='.urlencode($audio[0]['text']).'&tl='.$audio[0]['lang'].'');

    /**
     * Put the file into the destination directory that has been determined previously.
     */
    if(file_put_contents($audio[0]['path'].'/'.$audio[0]['file_name'].'.'.$audio[0]['audio_format'].'', $this->file)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Section to empty files in the destination directory that has been created.
   * This process will not delete the destination directory.
   */
  private $is_file;
  public function remove_audio($path) {
    foreach(glob($this->path.'/*') as $this->is_file) {
      if(is_dir($this->is_file)) {
        if(rmdir($this->is_file)) {
          return true;
        } else {
          return false;
        }
      } else {
        if(unlink($this->is_file)) {
          return true;
        } else {
          return false;
        }
      }
    }
  }

  /**
   * Detects the size of the files contained in the destination directory.
   */
  private $size, $units, $power;
  public function size($byte) {
    $this->size   = $byte;
    $this->units  = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $this->power  = ($this->size > 0 ? floor(log($this->size, 1024)) : 0);
    return ''.number_format(($this->size / pow(1024, $this->power)), 2, '.', ',').' '.$this->units[$this->power].'';
  }

  /**
   * Displays the entire contents of the files contained in the origin directory.
   */
  private $scanning;
  public function show_files(string $path) {
    $this->scanning = scandir($path);
    for($i = 2; $i < count($this->scanning); $i++) {
      echo ''.($i - 1).'. <a href="'.$path.'/'.$this->scanning[$i].'">'.$this->scanning[$i].'</a> ('.$this->size(filesize($path.'/'.$this->scanning[$i])).')<br/>';
    }
  }
}
?>
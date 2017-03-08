<?php

date_default_timezone_set('America/Denver');

function slugify($text) {
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

echo "\n".'Going to get me some Touts...'."\n"."\n";

if (($handle = fopen("tout.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		//Variables for each file
		$date = strtotime($data[2]);
		$views = str_pad($data[3], 5, '0', STR_PAD_LEFT);
        $slug = slugify($data[0]);
        $new_name = $views.'-'.$slug.'-'.$date.'.mp4';
        $new_csv = $new_name.','.$data[0].','.$data[2].',"'.$data[1].'",'.$data[3];
        
        //show it's running still
        echo 'Grabbing '.$new_name.'...'."\n";

        //video grabber
        $video_url = $data[5];
		$video_file = file_get_contents($video_url);

		//Add it to the list if it saves or add it to the failed list
        if (file_put_contents('./touts/'.$new_name, $video_file)) {
	        file_put_contents('new_touts.csv', $new_csv."\n", FILE_APPEND);
		} else {
			file_put_contents('failed.csv', $new_csv.','.$data[5]."\n", FILE_APPEND);
		}
    }
    fclose($handle);
}

echo "\n".'Got me a whole bunch of \'em!'."\n"."\n";

?>
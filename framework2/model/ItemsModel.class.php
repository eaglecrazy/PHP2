<?php

class ItemsModel
{
    public static function get_item($id)
    {
        $query = 'SELECT * FROM items WHERE id=:id';
        return Db::getInstance()->select($query, ['id' => $id])[0];
    }

    public static function get_all_items()
    {
        $query = 'SELECT * FROM items ORDER BY name';
        return Db::getInstance()->select($query, []);
    }

    public static function item_exist($name)
    {
        $query = 'SELECT * FROM items WHERE name=:name';
        return Db::getInstance()->select($query, ['name' => $name])[0];
    }

    public static function add_item($name, $cost, $description, $file_info)
    {
        if (self::item_exist($name))
            return 'error';//есть ошибка добавления

        //добавим запись в БД
        $query = 'INSERT INTO items (name, description, cost) VALUES (:name, :description, :cost)';
        Db::getInstance()->insert($query, ['name' => $name, 'description' => $description, 'cost' => $cost]);
        $id = Db::get_last_id();

        //сгенерируем пути
        $url_name = self::get_url_name($file_info['name']);
        $full_name = "/$id-$url_name";
        $path_small = Config::get('photo-small') . $full_name;
        $path_big = Config::get('photo-big') . $full_name;

        //добавим имя файла в БД
        $query = 'UPDATE items SET filename=:filename WHERE id=:id';
        Db::getInstance()->update($query, ['filename' => $full_name, 'id' => $id]);

        //переместим файл и создадим уменьшенную копию не более 250*156 пикселей
        //а обычную уменьшим до 750*468
        if (move_uploaded_file($file_info["tmp_name"], $path_big)) {
            self::image_resize($path_big, $path_big, 750, 468, 100);
            self::image_resize($path_small, $path_big, 250, 156, 100);
        }

        return 'ok';
    }

    //перевод названия в транслит без пробелов
    private static function get_url_name($str)
    {
        $transliteration = [
            'ё' => 'yo',
            'й' => 'y',
            'ц' => 'ts',
            'у' => 'u',
            'к' => 'k',
            'е' => 'e',
            'н' => 'n',
            'г' => 'g',
            'ш' => 'sh',
            'щ' => 'sch',
            'з' => 'z',
            'х' => 'kh',
            'ф' => 'f',
            'ы' => 'y',
            'в' => 'v',
            'а' => 'a',
            'п' => 'p',
            'р' => 'r',
            'о' => 'o',
            'л' => 'l',
            'д' => 'd',
            'ж' => 'zh',
            'э' => 'e',
            'я' => 'ya',
            'ч' => 'ch',
            'с' => 's',
            'м' => 'm',
            'и' => 'i',
            'т' => 't',
            'б' => 'b',
            'ю' => 'yu'
        ];
        $s = str_replace(' ', '_', $str);
        $s = strtr(mb_strtolower($s), $transliteration);
        //удалим недопустимые символы
        return preg_replace("/[^a-z0-9.\-]/i", '', $s);
    }


    //изменение размеров изображения
    private static function image_resize($outfile, $infile, $neww, $newh, $quality)
    {
        $im = imagecreatefromjpeg($infile);
        $k1 = $neww / imagesx($im);
        $k2 = $newh / imagesy($im);
        $k = $k1 > $k2 ? $k2 : $k1;

        $w = intval(imagesx($im) * $k);
        $h = intval(imagesy($im) * $k);

        $im1 = imagecreatetruecolor($w, $h);
        imagecopyresampled($im1, $im, 0, 0, 0, 0, $w, $h, imagesx($im), imagesy($im));

        imagejpeg($im1, $outfile, $quality);
        imagedestroy($im);
        imagedestroy($im1);
    }
}
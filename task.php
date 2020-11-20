<?php

$file_name = $argv[1];
$operation = $argv[2];

$file = new File();


$file->write("positive.txt", "");
$file->write("negative.txt", "");


if (file_exists($file_name)) {
	$data = $file->read($file_name);

	$values = explode("\n", $data);

	foreach ($values as $value) {
		if (!empty($value)) {
			$value1 = explode(" ", $value)[0];
			$value2 = explode(" ", $value)[1];

			switch ($operation) {
				case '*':
					$result = $value1 * $value2;
					break;
				case '/':
					$result = $value1 / $value2;
					break;
				case '+':
					$result = $value1 + $value2;
					break;
				case '-':
					$result = $value1 - $value2;
					break;
				default:
					$file->error("Ошибка. Программа может работать только с текущими операциями: ('*') - умножение, (/) - деление, (+) - сложение, (-) - вычитание \n");
					break;
			}

			if (isset($result)) {
				if ($result >= 0) {
					$file->write("positive.txt", $result . "\n");
				} else {
					$file->write("negative.txt", $result . "\n");
				}
			}
		}
	}
} else {
	$file->error("Не существует файл с именем " . $file_name . ". Сначало создайте файл и повторите попытку.\n");
}


class File {
	public function read($file_name) {
		return file_get_contents($file_name);
	}

	public function write($file_name, $text) {
		if ($text !== "") {
			file_put_contents($file_name, $text, FILE_APPEND);	
		} else {
			file_put_contents($file_name, $text);
		}
		
	}

	public function error($text) {
		echo $error;
	}
}
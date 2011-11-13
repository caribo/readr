<?php

function filenameToIconName($filename) {
		$fileparts = explode(".", $filename);
		$extension = $fileparts[sizeof($fileparts)-1];
		switch($extension) {
			case "jpg":
			case "jpeg":
			case "jpe":
			case "gif":
			case "bmp":
			case "tif":
			case "tiff":
			case "eps":
			case "ai":
			case "psd":
			case "wbmp":
				return "image";
				break;
			case "zip":
			case "rar":
			case "gz":
			case "7z":
			case "sit":
			case "ace":
			case "xz":
			case "tar":
				return "archive";
				break;
			case "mp3":
			case "wav":
			case "flac":
			case "ogg":
			case "vob":
			case "aiff":
			case "mid":
			case "wma":
			case "m4a":
				return "audio";
				break;
			case "doc":
			case "docx":
			case "odt":
			case "doc":
				return "document";
				break;
			case "ppt":
			case "pptx":
				return "presentation";
				break;
			case "pdf":
				return "pdf";
				break;
			default:
				return "file";
				break;
		}
}

function truncateString($string, $length) {
    if (strlen($string) > $length) {
		$string = substr($string,0,($length -3));
		$string = substr($string,0,strrpos($string,' ')).'...';
    }
    return $string;
}
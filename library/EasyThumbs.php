<?php
class EasyThumbs
{
	public 	  $imagesettings = array(); // This holds the settings for image thumb
	protected $image_details;		// This holds the details for image
	protected $imagefrom;			// This goes for imagecreatefrom
	protected $image_width; 		// This goes for getimagesize();
	protected $image_height; 		// This goes for getimagesize();
	protected $image_type; 			// This goes for getimagesize();
	protected $image_attributes; 	// This goes for getimagesize(); -> http://www.php.net/manual/en/function.getimagesize.php
	
	/**
         * With this function you can create thumbnails on pictures
         * @param <type> $imagesettings
         * @param <type> $auto_calc
         */
	
	public function CreateThumb($imagesettings, $auto_calc = 'false')
	{
		$this->imagesettings = $imagesettings;
		self::GetImageDetails($imagesettings);
			
		if($auto_calc == 'false' && $this->image_details['mime'] != 'image/gif')
		{
			$this->truecolor = imagecreatetruecolor($this->imagesettings['image_new_width'], $this->imagesettings['image_new_height']);	
			imagecopyresampled($this->truecolor, $this->imagefrom, 0, 0, 0, 0, $this->imagesettings['image_new_width'], $this->imagesettings['image_new_height'], $this->image_details['0'], $this->image_details['1']);
			self::SaveImage($this->imagesettings);
		}
		else
		{
			if($auto_calc == 'true' && $this->image_details['mime'] != 'image/gif')
			{	
				$this->new_height = floor($this->image_details['image_height'] * ($this->imagesettings['image_new_width']) / $this->image_details['image_width']);
				imagecopyresampled($this->truecolor, $this->imagefrom, 0, 0, 0, 0, $this->imagesettings['image_new_width'], $this->new_height, $this->image_details['0'], $this->image_details['1']);
				self::SaveImage();
			}
		}
	}

        /**
         *  With this function you can check image details
         *
         */

	public function GetImageDetails()
	{
			$image_details = $this->image_details;
			$image_width = $this->image_width;
	 		$image_height = $this->image_height;
	 		$image_type = $this->image_type;
			$image_attributes = $this->image_attributes;
			if(file_exists($this->imagesettings['image_original_path']))
			{
				$this->image_details = list($this->image_width, $this->image_height, $this->image_type, $this->image_attributes) = getimagesize($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
				$this->CheckMimeType($this->image_details);
			}
			else
			{
				// FIXME : HERE IT SHOULD OUTPUT AN ERROR
				// TODO : ADD A LOG FILE OR SOMETHING!
				// TODO: TO DISCUSS THIS MORE...
			}
			
			self::CheckMimeType();
	}

        /**
         *  This one checks for Mime Type
         */

	public function CheckMimeType()
	{
		$imagefrom = $this->imagefrom;
		//FIXME: This one not sure here how should be :-? needs a little bit more work on it
		if(array_key_exists('mime', $this->image_details))
		{
			switch($this->image_details['mime'])
			{
				case ($this->image_details['mime'] == 'image/jpeg'):
					$this->imagefrom = imagecreatefromjpeg($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
					break;
				case ($this->image_details['mime'] == 'image/jpg'):
					$this->imagefrom = imagecreatefromjpeg($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
					break;
				case ($this->image_details['mime'] == 'image/gif'):
					$this->imagefrom = imagecreatefromgif($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
					break;
				case ($this->image_details['mime'] == 'image/png'):
					$this->imagefrom = imagecreatefrompng($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
					break;
				case ($this->image_details['mime'] == 'image/bmp'):
					$this->imagefrom = imagecreatefromwbmp($this->imagesettings['image_original_path'] . $this->imagesettings['image_name']);
					break;
			}
		}
	}

        /**
         * With this one you save a psyhical copy on hdd in the folder you want.
         * @param <type> $imagesettings
         */

	public function SaveImage($imagesettings)
	{
		switch($this->imagesettings)
		{
			case ($this->imagesettings['image_save_as'] === 'jpeg'):
				imagejpeg($this->truecolor, $this->imagesettings['image_new_path'] . $this->imagesettings['image_new_name'] . '.jpeg');
				break;
			case ($this->imagesettings['image_save_as'] === 'jpg'):
				imagejpeg($this->truecolor, $this->imagesettings['image_new_path'] . $this->imagesettings['image_new_name'] . '.jpg');
				break;
			case ($this->imagesettings['image_save_as'] === 'png'):
				imagepng($this->truecolor, $this->imagesettings['image_new_path'] . $this->imagesettings['image_new_name'] . '.png');
				break;
			case ($this->imagesettings['image_save_as'] === 'gif'):
				imagegif($this->truecolor, $this->imagesettings['image_new_path'] . $this->imagesettings['image_new_name'] . '.gif');
				break;
			case ($this->imagesettings['image_save_as'] === 'bmp'):
				imagewbmp($this->truecolor, $this->imagesettings['image_new_path'] . $this->imagesettings['image_new_name'] . '.bmp');
				break;
		}
	}
}
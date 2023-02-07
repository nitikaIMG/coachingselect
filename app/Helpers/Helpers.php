<?php
namespace App\Helpers;
Use Config;
Use Redirect;
Use Session;
Use Input;
Use HTML;
Use URL;
Use DB;
Use Firebase;
Use Push;
Use Mail;
Use Response;
Use Image;
Use Swift_SmtpTransport;
Use Swift_Mailer;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\RegisteruserController;
use App\Http\Controllers\FeedController;
use Twilio\Rest\Client;
use App\Registerusers;
class Helpers
{
	public static function imageSingleUpload($file,$destinationPath,$fileName){
		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		$ext = array("jpg","jpeg","png","JPG","PNG","JPEG");
		
		if(!in_array($extension, $ext)){
			return false;
		}  
		$newfilename = $fileName.'.'.$extension;
		if(file_exists($destinationPath.'/'.$newfilename)){
			$info=pathinfo($newfilename);
			$imageNamee=$info['filename'].'.'.$fileName;
			$newfilename=$imageNamee.'.'.$extension;
		}
		$resi = $destinationPath .'/'. $newfilename;
		$upload_success = $file->move($destinationPath, $newfilename);
		
		return $newfilename;
	}
	
	public static function imageSingleUpload1($file,$destinationPath,$fileName){
		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		$ext = array("jpg","jpeg","png","JPG","PNG","JPEG");
		
		if(!in_array($extension, $ext)){
			return false;
		}  
		$newfilename = $fileName.'.'.$extension;
		$webp = $fileName.'.webp';
		if(file_exists($destinationPath.'/'.$newfilename)){
			$info=pathinfo($newfilename);
			$imageNamee=$info['filename'].'.'.$fileName;
			$newfilename=$imageNamee.'.'.$extension;
			$webp=$imageNamee.'.webp';
		}
		$resi = $destinationPath .'/'. $newfilename;
		$webp_resi = $destinationPath .'/'. $webp;
		$upload_success = $file->move($destinationPath, $newfilename);
		
		// convert image to webp
		// $original_extension = strtolower($extension);

		// if($original_extension == 'jpg') {
		// 	$image_source = imagecreatefromjpeg($resi);
		// } else if($original_extension == 'jpeg') {
		// 	$image_source = imagecreatefromjpeg($resi);
		// } else if($original_extension == 'png') {
		// 	$image_source = imagecreatefrompng($resi);
		// } else {			
		// 	$image_source = imagecreatefromgif($resi);
		// }

		// imagewebp($image_source);

		$image_content = imagecreatefromstring( file_get_contents($resi) );

		imagewebp($image_content, $webp_resi);
		
		@unlink($resi);

		// return $newfilename;
		return $webp;
	}

	public static function imageUpload1($file,$destinationPath,$fileName){
		$array=array();
		foreach($file as $fileimage){
				$filename = $fileimage->getClientOriginalName();
				
				$extension = $fileimage->getClientOriginalExtension();
					$ext = array('jpg','JPG','jpeg', 'gif', 'png');
					if(!in_array($extension, $ext)){
						return false;
					} 
					$newfilename = $fileName.'.'.$extension;
					$webp = $fileName.'.webp';
					
					if(file_exists($destinationPath.'/'.$webp)){
						$info=pathinfo($newfilename);
						$imageNamee=$info['filename'].'-'.rand(100,999);
						$newfilename=$imageNamee.".".$info['extension'];
						$webp=$imageNamee.'.webp';
					}

					// $array[]=$newfilename;
					$array[]=$webp;
					$upload_success = $fileimage->move($destinationPath, $newfilename);
					$resi = $destinationPath .'/'. $newfilename;
					$webp_resi = $destinationPath .'/'. $webp;
					/*$resizeimage=Helpers::resize_image($resi);
					$resizeimage=Helpers::compress_image($resi,100);*/
			
					$image_content = imagecreatefromstring( file_get_contents($resi) );

					imagewebp($image_content, $webp_resi);
					
					@unlink($resi);

			 }

				// dd($array);
				
			  $imageNames = implode('{$}',$array);
			  return $imageNames;
	}
	
	public static function upload_pdf($file,$destinationPath,$fileName){
		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		$ext = array("pdf", 'PDF');
		
		if(!in_array($extension, $ext)){
			return false;
		}  
		$newfilename = $fileName.'.'.$extension;
		if(file_exists($destinationPath.'/'.$newfilename)){
			$info=pathinfo($newfilename);
			$imageNamee=$info['filename'].'.'.$fileName;
			$newfilename=$imageNamee.'.'.$extension;
		}
		$resi = $destinationPath .'/'. $newfilename;
		$upload_success = $file->move($destinationPath, $newfilename);
		
		return $newfilename;
	}

	
	# project settings : project name, app id etc.
	# @param optional : type = website
	public static function settings($type = ''){

		$settings = DB::table('settings');

		if( !empty($type) ) {
		$settings = $settings->where('type', $type);
		}

		$settings = $settings->pluck('value', 'name')
							->toArray();

		if( !empty($settings) ) {
			return (Object) $settings;
		} else {
		return false;
		}

	}

	public static function videoSingleUpload($file,$destinationPath,$fileName){
		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		$extension = strtoupper($extension);
		$ext = array("WMV","WEBM","MP4","MOV", "AVI", "MKV");
		
		if(!in_array($extension, $ext)){
			return false;
		}  
		$newfilename = $fileName.'.'.$extension;
		if(file_exists($destinationPath.'/'.$newfilename)){
			$info=pathinfo($newfilename);
			$imageNamee=$info['filename'].'.'.$fileName;
			$newfilename=$imageNamee.'.'.$extension;
		}
		$resi = $destinationPath .'/'. $newfilename;
		$upload_success = $file->move($destinationPath, $newfilename);
		
		return $newfilename;
	}

	public static function imageUpload($file,$destinationPath,$fileName){
		$array=array();
		foreach($file as $fileimage){
				$filename = $fileimage->getClientOriginalName();
					$extension = $fileimage->getClientOriginalExtension();
					$ext = array('jpg','JPG','jpeg', 'gif', 'png');
					if(!in_array($extension, $ext)){
						return false;
					} 
					$newfilename = $fileName.'.'.$extension;
					if(file_exists($destinationPath.'/'.$newfilename)){
						$info=pathinfo($newfilename);
						$imageNamee=$info['filename'].'-'.rand(100,999);
						$newfilename=$imageNamee.".".$info['extension'];
					}
					$array[]=$newfilename;
					$upload_success = $fileimage->move($destinationPath, $newfilename);
					$resi = $destinationPath .'/'. $newfilename;
					/*$resizeimage=Helpers::resize_image($resi);
					$resizeimage=Helpers::compress_image($resi,100);*/
			 }
			  $imageNames = implode('{$}',$array);
			  return $imageNames;
	}
	public static function videoUpload($file,$destinationPath,$fileName){
		$array=array();
		foreach($file as $fileimage){
				$filename = $fileimage->getClientOriginalName();
					$extension = $fileimage->getClientOriginalExtension();
					$ext = array('mp4','mkv','avi', 'mov', 'wmv');
					if(!in_array($extension, $ext)){
						return false;
					} 
					$newfilename = $fileName.'.'.$extension;
					if(file_exists($destinationPath.'/'.$newfilename)){
						$info=pathinfo($newfilename);
						$imageNamee=$info['filename'].'-'.rand(100,999);
						$newfilename=$imageNamee.".".$info['extension'];
					}
					$array[]=$newfilename;
					$upload_success = $fileimage->move($destinationPath, $newfilename);
					$resi = $destinationPath .'/'. $newfilename;
					/*$resizeimage=Helpers::resize_image($resi);
					$resizeimage=Helpers::compress_image($resi,100);*/
			 }
			  $imageNames = implode('{$}',$array);
			  return $imageNames;
	}
	
	public static function mailsentFormat($email, $subject, $template){
// 		$datamessage['email']=$email;
// 		$datamessage['subject']=$subject;
		
// 	    Mail::send('mails.'.$template, compact(''), function ($m) use ($datamessage){
// 			$m->from('support@coachingselect.com', 'CoachingSelect');
// 			$m->to($datamessage['email'])->subject($datamessage['subject']);
// 		});
	}
	
	public static function session($name){
		return Session::get($name);
	}

	public static function sendTextSmsNew($txtmsg,$mobile){
	    
		$mobile=str_replace('$$',',',$mobile);
		$txtmsg=rawurlencode($txtmsg);
		
	    $url="http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=0a202e1c26bf1352d7667738dde2191e&mobiles=$mobile&message=$txtmsg&sender=AGFCPL&route=B";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);
	}
	
}
?>
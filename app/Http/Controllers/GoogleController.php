<?php

namespace App\Http\Controllers;

use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Http\Request;


class GoogleController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getCustomerCardData(Request $request)
    {
$result='';
        try {









            $image_string = @$request->imgbase64;
            $images=['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg',
                '11.jpg','12.jpg','13.jpg','14.jpg','15.jpg','16.jpg','17.jpg','18.jpg','19.jpg','20.jpg',
                '20.jpg','21.jpg','22.jpg','23.jpg','24.jpg'];
            foreach ($images as $key=> $img){

                $image_string = base64_encode(file_get_contents('newimgs/'.$img));

                putenv('GOOGLE_APPLICATION_CREDENTIALS=key.json');
                $phone = '';
                $website = '';
                $address = '';
                $name = '';
                $email = '';



                $imageAnnotator = new ImageAnnotatorClient();


                $imageData = base64_decode($image_string);
                $image = (new Image())
                    ->setContent($imageData);


                $response = $imageAnnotator->documentTextDetection($image);
                $labels = $response->getFullTextAnnotation();
                $result.=$labels->getText().'<br><br><br> This is new string <br><br>';

            }
print_r($result);
           dd('$result');


            $regex = "/([a-zA-Z]+[ \t]+[a-zA-Z]+)|([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/";
            $phone_pattern = '/(\+?1[-. ]?)?\(?\d{3,4}\)?[- ]?\d{3,4}[- ]?\d{4}/';
             $address_pattern = '/\b\d{4,5}\b.*?(AK|AL|AR|AZ|CA|CO|CT|DC|DE|FL|GA|HI|IA|ID|IL|IN|KS|KY|LA|MA|MD|ME|MI|MN|MO|MS|MT|NC|ND|NE|NH|NJ|NM|NV|NY|OH|OK|OR|PA|RI|SC|SD|TN|TX|UT|VA|VT|WA|WI|WV|WY|US|street|block|avenue|)\b/i';
            $address_pattern='/ (?!.*\.com) [A-Z]{2}|\S*[A-Za-z!@#$%^&*()_+|~-]?\d{3,5}[A-Za-z!@#$%^&*()_+|~-]?\S*   (\d++)    # Number (one or more digits) -> $matches[1]\s++      # Whitespace([^,]++), # Building + City (everything up until a comma) -> $matches[2]\s++      # Whitespace
(\S++)    # "DC" part (anything but whitespace) -> $matches[3]
\s++      # Whitespace
(\d++)    # Number (one or more digits) -> $matches[5]
/x';
            $address_pattern='/(\S*[A-Za-z!@#$%^&*()_+|~-]?(?:[A-Z]{2}|\d{3,5})[A-Za-z!@#$%^&*()_+|~-]?\S*)/';
            $website_pattern = '/((?:https?:\/\/)?(?:www\.)?(?:[\w-]+\.[\w]{2,}|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?:\/[\w-])(?:\?.)?(?:#\S)?)/';
            $website_pattern = '/((?:https?:\/\/)?(?:www\.)?(?:[\w-]+\.[\w]{2,}|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?:\/[\w-])?(?:\?.)?(?:#[\w-]*)?[a-zA-Z]*)/';
// dd($labels->getText());
            $data=$labels->getText();
print_r($data);
dd('s');
            $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
            preg_match_all($pattern, $data, $matches);
            $email=$matches[0];
            $email=$email[0];
            if (preg_match_all($phone_pattern, $data, $phone_matches)) {
                if (!empty($phone_matches[0])) {
                    foreach ($phone_matches[0] as $rec) {
                        $phone .= $rec . '  ';
                        $data= str_replace($rec,"",$data);

                    }
                }


            }
            if (preg_match_all($website_pattern, $data, $website_matches)) {


                if (!empty($website_matches[0])) {
                    foreach ($website_matches[0] as $rec) {
                        $website .= $rec . '  ';
                        $data= str_replace($rec,"",$data);


                    }
                }
            }
            if (preg_match_all($regex, $data, $matches)) {
                $names = $matches[1];
                $emails = $matches[2];

                if (!empty($names)) {
                    foreach ($names as $rec) {
                        $name .= $rec . '  ';
                        $data= str_replace($rec,"",$data);
                        break;



                    }
                }

                if (!empty($emails)) {

                    foreach ($emails as $rec) {
                        $email .= $rec . '  ';
                        $data= str_replace($rec,"",$data);
                        break;


                    }
                }
            }

            if (preg_match_all($address_pattern, $data, $address_matches)) {
// dd('as');
                if (!empty($address_matches[0])) {
                    foreach ($address_matches[0] as $rec) {
                        // dd($rec,$address_matches);
                        $address .= $rec . '  ';
                        $data= str_replace($rec,"",$data);


                    }
                }


            }


            $address=str_replace("\n","",$address);






            $result = ['Name' => @$name, 'Email' => @$email, 'Address' => @$address, 'Phone' => @$phone, 'website' => @$website,'string'=>$data];
            return $result;
        }
        catch (\Exception $e) {
            // Exception caught and handled here
            echo "Caught exception: " . $e->getMessage(); // Output the error message
        }

    }


}





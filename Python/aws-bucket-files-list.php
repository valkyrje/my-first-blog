<?php
// Access Key ID:
// AKIAIXLT7KHVH5J465VQ
// Secret Access Key:
// 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

//phpinfo();
//set_time_limit(0);


	require './amazon-sdk-php/aws-autoloader.php';

	$s3 = new Aws\S3\S3Client([
	    'version' => 'latest',
	    //'region'  => 'us-west-2',
	    'region'  => 'eu-central-1',
	    'credentials' => [
	        //'key'    => 'AKIAJHVD4F7QPUGW7XRA',
	        //'secret' => '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'
	   		'key'    => 'AKIAIVA56WB4LKW27PCA',
	        'secret' => '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'
	    ]
	]);

	$s3->registerStreamWrapper();

	//$dir = "s3://my-bucket-for-testing/";
	$dir = "s3://elinstitutodelaemprendedoraonline/";

	/*if (is_dir($dir) && ($dh = opendir($dir))) {
	    while (($file = readdir($dh)) !== false) {
	        echo "filename: {$file} : filetype: " . filetype($dir . $file) . "\n";
	    }
	    closedir($dh);
	}*/

	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));


	foreach ($iterator as $file) {
	    

	    try {

				//$myFile = str_replace("s3://my-bucket-for-testing/", "", $file);
				$myFile = str_replace("s3://elinstitutodelaemprendedoraonline/", "", $file);

				$pos = strripos($myFile, "/");

					/*$s3->putObject([
				        'Bucket' => 'vl-tester',
				        'Key'    => 'old' .$path,
				        'Body'   => $file,
				        'ACL'    => 'private'
				    ]); */

					// Get the object
				    $result = $s3->getObject(array(
				        //'Bucket' => 'my-bucket-for-testing',
				        'Bucket' => 'elinstitutodelaemprendedoraonline',
				        'Key'    => $myFile,
				        'SaveAs' => 'files/' . $myFile
				    ));

				
					echo $pos . "\n";
					echo $file->getType() . ': ' . $myFile . "\n";



			} catch (Aws\Exception\S3Exception $e) {
			     echo "There was an error uploading the file.\n";
			}

	






	}



	

  	echo "\nDone!\n";
  	
?>